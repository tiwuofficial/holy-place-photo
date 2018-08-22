<?php

namespace App\Http\Controllers;

class UserController extends Controller
{

    /**
     * ユーザー詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('user.show');
    }
}
