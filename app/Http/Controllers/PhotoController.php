<?php

namespace App\Http\Controllers;

use App\Model\Anime;
use App\Model\Like;
use App\Model\Photo;
use App\Model\PhotoUrl;
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
        $s3Url = env('AWS_S3_URL');
        return view('photo.show', compact('photo', 'userPhotos','animePhotos' ,'s3Url'));
    }

    /**
     * 写真投稿
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $animes = Anime::all();
        return view('photo.create', compact('animes'));
    }

    /**
     * 写真投稿処理
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->session()->get('userId');

        DB::transaction(function () use($data, $request) {
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
        return view('photo.edit',compact('photo', 'animes'));
    }

    /**
     * 写真編集処理
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update()
    {
        return redirect('/');
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
