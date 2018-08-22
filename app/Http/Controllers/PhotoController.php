<?php

namespace App\Http\Controllers;

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
        return view('photo.create');
    }

    /**
     * 写真投稿処理
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
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
