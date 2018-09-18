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
        return view('anime.index', compact('animesHavePhoto', 'animesNotHavePhoto'));
    }

    /**
     * アニメ詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Anime $anime)
    {
        return view('anime.show', compact('anime'));
    }
}
