<?php

namespace App\Http\Controllers;

use App\Model\Anime;
use App\Model\Photo;
use App\Model\PhotoUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    /**
     * 写真詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('photo.show');
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
        $photoModel = Photo::create($data);

        $photos =  $request->file('photos');
        foreach ($photos as $photo) {
            $url = Storage::disk('s3')->putFile('/photos', $photo, 'public');

            $photoUrl = new PhotoUrl();
            $photoUrl->photo_id = $photoModel->id;
            $photoUrl->url = $url;
            $photoUrl->save();
        }

        return redirect('/');
    }

    /**
     * 写真編集
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('photo.edit');
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
    public function destory()
    {
        return redirect('/');
    }
}
