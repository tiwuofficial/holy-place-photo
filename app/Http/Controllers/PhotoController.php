<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Model\Anime;
use App\Model\Like;
use App\Model\Photo;
use App\Model\PhotoUrl;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        $userPhotos = Photo::where('user_id', $photo->user_id)->where('id','!=', $photo->id)->get();
        $animePhotos = Photo::where('anime_id', $photo->anime_id)->where('id','!=', $photo->id)->get();
        return view('photo.show', compact('photo', 'userPhotos','animePhotos'));
    }

    /**
     * 写真投稿
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $animes = Anime::all();
        $user = User::where('id',$request->session()->get('userId'))->first();
        return view('photo.create', compact('animes', 'user'));
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
        $animes = Anime::all();
        $photo = Photo::where('id', $photo->id)->with('urls')->first();
        return view('photo.edit',compact('photo', 'animes'));
    }

    /**
     * 写真編集処理
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Photo $photo)
    {
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
