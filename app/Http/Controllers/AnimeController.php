<?php

namespace App\Http\Controllers;

use App\Model\Anime;
use Illuminate\Support\Facades\Log;

class AnimeController extends Controller
{

    /**
     * アニメ一覧
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $animesHavePhoto = Anime::has('photos')->get();
        $animesNotHavePhoto = Anime::has('photos', '=', 0)->get();

        $title = '【Holy Place Photo】アニメの一覧';
        $description = 'アニメの一覧です。気になるアニメを選んで写真を探してみましょう。';
        return view('anime.index', compact('animesHavePhoto', 'animesNotHavePhoto', 'title', 'description'));
    }

    /**
     * アニメ詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Anime $anime)
    {
        $title = '【Holy Place Photo】' . $anime->name;
        $description = $anime->name . 'の詳細です。気になる写真を選んでみましょう。';
        return view('anime.show', compact('anime', 'title', 'description'));
    }
}
