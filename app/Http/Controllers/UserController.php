<?php

namespace App\Http\Controllers;

use App\Model\Photo;
use App\User;

class UserController extends Controller
{

    /**
     * ユーザー詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $userPhotos = Photo::where('user_id', $user->id)->get();
        $title = $user->name . 'さんの聖地の写真一覧。【Holy Place Photo】アニメの聖地の写真の投稿';
        $description =  $user->name . 'さんの聖地の写真一覧です。【Holy Place Photo】はアニメの聖地の写真の共有サイトです。';
        return view('user.show', compact('title', 'description', 'userPhotos', 'user'));
    }
}
