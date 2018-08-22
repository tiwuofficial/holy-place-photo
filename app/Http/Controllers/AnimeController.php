<?php

namespace App\Http\Controllers;

class AnimeController extends Controller
{

    /**
     * アニメ一覧
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('anime.index');
    }

    /**
     * アニメ詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('anime.show');
    }
}
