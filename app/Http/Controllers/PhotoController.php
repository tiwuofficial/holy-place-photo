<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\PhotoUpdateRequest;
use App\Model\Anime;
use App\Model\Like;
use App\Model\Photo;
use App\Model\PhotoUrl;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    /**
     * 写真詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Photo $photo)
    {
        $summaryLargeImage = true;
        $googleAdsense = true;

        $title = '【Holy Place Photo】' . $photo->title . ' | アニメ「' . $photo->anime_name . '」の聖地の写真の詳細';
        $description = 'アニメ「' . $photo->anime_name . '」の聖地の写真です。タイトル「' . $photo->title . '」【Holy Place Photo】はアニメの聖地の写真の共有サイトです。';
        return view('photo.show', compact('photo', 'userPhotos','animePhotos', 'summaryLargeImage', 'title', 'description', 'googleAdsense'));
    }

    /**
     * 写真投稿
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $user = User::where('id',$request->session()->get('userId'))->first();

        $title = '【Holy Place Photo】アニメの聖地の写真の投稿';
        $description = 'アニメの聖地の写真を投稿ができます。アニメや聖地などを選択し、投稿してください。【Holy Place Photo】はアニメの聖地の写真の共有サイトです。';
        return view('photo.create', compact('user', 'title', 'description'));
    }

    /**
     * 写真投稿処理
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PhotoRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->session()->get('userId');
        DB::transaction(function () use($data, $request) {
            $user = User::where('id', $data['user_id'])->first();
            $user->name = $data['name'];
            $user->save();

            $photoModel = Photo::create($data);
            $photos =  $request->file('photos');
            foreach ($photos as $photo) {
                $url = Storage::disk('s3')->putFile('/photos', $photo, 'public');

                $photoUrl = new PhotoUrl();
                $photoUrl->photo_id = $photoModel->id;
                $photoUrl->url = $url;
                $photoUrl->save();
            }
            if (app()->environment('production')) {
                $con = new TwitterOAuth(env('TWITTER_CLIENT_ID'),
                    env('TWITTER_CLIENT_SECRET'),
                    env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
                    env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET'));
                $con->post("statuses/update", [
                    "status" =>
                        'New Photo Post!'.PHP_EOL.
                        '新しい聖地の写真が投稿されました!'.PHP_EOL.
                        'タイトル「'.$data['title'].'」'.PHP_EOL.
                        '#photo #anime #photography #アニメ #聖地 #写真 #HolyPlacePhoto'.PHP_EOL.
                        'https://www.holy-place-photo.com/photos/'.$photoModel->id
                ]);
            }
        });

        return redirect('/');
    }

    /**
     * 写真編集
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Photo $photo)
    {
        if(!Hash::check($request->password, $photo->password)) {
            abort('404');
        }
        $animes = Redis::hGetAll('anime');
        $photo = Photo::where('id', $photo->id)->with('urls')->first();

        $title = '【Holy Place Photo】写真の編集';
        $description = '投稿した写真の編集ができます。';
        return view('photo.edit',compact('photo', 'animes', 'title', 'description'));
    }

    /**
     * 写真編集処理
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PhotoUpdateRequest $request, Photo $photo)
    {
        if(!Hash::check($request->edit_password, $photo->password)) {
            abort('404');
        }
        $data = $request->all();
        DB::transaction(function () use($data, $request, $photo) {
            $photo->fill($data)->save();
            // アップロードされた写真の登録
            $inputPhotos = $request->file('photos', []);
            foreach ($inputPhotos as $inputPhoto) {
                $url = Storage::disk('s3')->putFile('/photos', $inputPhoto, 'public');

                $photoUrl = new PhotoUrl();
                $photoUrl->photo_id = $photo->id;
                $photoUrl->url = $url;
                $photoUrl->save();
            }

            // 画像の削除
            $deletePhotoUrls = explode(',', $request->input('deletePhotoUrls')[0]);
            if (!empty($deletePhotoUrls)) {
                Storage::disk('s3')->delete($deletePhotoUrls);
                PhotoUrl::whereIn('url', $deletePhotoUrls)->delete();
            }
        });
        return redirect(action('PhotoController@show', $photo->id));
    }

    /**
     * 写真削除処理
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destory(Request $request, Photo $photo)
    {
        if(!Hash::check($request->password, $photo->password)) {
            abort('404');
        }
        DB::transaction(function () use($photo) {
            $photoUrls = PhotoUrl::where('photo_id', $photo->id)->get();
            foreach ($photoUrls as $photoUrl) {
                Storage::disk('s3')->delete($photoUrl->url);
                $photoUrl->delete();
            }
            $photo->delete();
        });
        return redirect('/');
    }
}
