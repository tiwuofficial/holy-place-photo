<?php

namespace App\Http\Controllers;

use App\Model\Inquiry;
use Illuminate\Http\Request;

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
        $hoge = Inquiry::all();
        return view('top.inquiry', compact('hoge'));
    }

    public function inquiryStore(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);
        $data = $request->all();
        Inquiry::create($data);
        return redirect('/inquiry')->with('status', '入力内容を送信しました！');
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
