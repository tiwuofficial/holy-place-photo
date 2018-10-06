<?php

namespace App\Http\Controllers;

use App\Model\Anime;
use App\Model\Inquiry;
use App\Model\Photo;
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
        $animesHavePhoto = Anime::has('photos')->get();
        $photos = Photo::with('urls', 'anime')->take(2)->get();
        return view('top.index', compact('photos', 'animesHavePhoto'));
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

    public function inquiryStore(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);
        $data = $request->all();
        Inquiry::create($data);
        return redirect('/inquiry')->with('status', 'お問い合わせ内容を送信しました！');
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

    /**
     * 利用規約
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function kiyaku()
    {
        return view('top.kiyaku');
    }

    /**
     * プライバシーポリシー
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        return view('top.privacy');
    }
}
