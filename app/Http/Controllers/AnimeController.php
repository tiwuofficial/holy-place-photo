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
        $animes = Anime::all();
        return view('anime.index', compact('animes'));
    }

    /**
     * アニメ詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $anime = Anime::where('id', $id)->first();
        return view('anime.show', compact('anime'));
    }
}
