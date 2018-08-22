<?php

namespace App\Http\Controllers;

class TopController extends Controller
{

    /**
     * トップ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('top.index');
    }

    /**
     * 問い合わせ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inquiry()
    {
        return view('top.inquiry');
    }

    /**
     * ガイドライン
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guide()
    {
        return view('top.guide');
    }

    /**
     * サイトについて
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('top.about');
    }
}
