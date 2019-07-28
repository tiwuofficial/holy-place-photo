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
        $top = true;
        $googleAdsense = true;

        $title = '【Holy Place Photo】アニメの聖地の写真の共有サイト';
        $description = 'アニメの聖地で撮った写真を共有できるサイトです。好きなアニメの聖地の写真を投稿したり、聖地を地図から探したりして楽しんでください。';
        return view('top.index', compact('title', 'description', 'top', 'googleAdsense'));
    }

    public function story()
    {
        $photos = Photo::with('urls', 'anime')->orderBy('created_at', 'desc')->paginate(5);

        $canonicalUrl = action('TopController@story');
        $title = '【Holy Place Photo】アニメの聖地の写真の共有サイト';
        $description = 'アニメの聖地で撮った写真を共有できるサイトです。好きなアニメの聖地の写真を投稿したり、聖地を地図から探したりして楽しんでください。';
        return view('amp.story', compact('title', 'description', 'photos', 'canonicalUrl'));
    }

    /**
     * 問い合わせ
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function inquiry()
    {
        $title = '【Holy Place Photo】お問い合わせ';
        $description = 'Holy Place Photoに関するお問い合わせはこちらからお願いします。';
        return view('top.inquiry', compact('title', 'description'));
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
        $title = '【Holy Place Photo】サイトについて';
        $description = 'Holy Place Photoについての説明です。';
        return view('top.about', compact('title', 'description'));
    }

    /**
     * 利用規約
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function kiyaku()
    {
        $title = '【Holy Place Photo】利用規約';
        $description = 'Holy Place Photoの利用規約です。';
        return view('top.kiyaku', compact('title', 'description'));
    }

    /**
     * プライバシーポリシー
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        $title = '【Holy Place Photo】プライバシーポリシー';
        $description = 'Holy Place Photoの利用規約です。';
        return view('top.privacy', compact('title', 'description'));
    }
}
