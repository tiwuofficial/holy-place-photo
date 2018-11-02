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
        $googleAdsense = true;

        $title = '【Holy Place Photo】アニメの一覧 | 聖地の写真の共有';
        $description = 'アニメの一覧です。気になるアニメを選んで聖地の写真を探してみましょう。【Holy Place Photo】はアニメの聖地の写真の共有サイトです。';
        return view('anime.index', compact('animesHavePhoto', 'animesNotHavePhoto', 'title', 'description', 'googleAdsense'));
    }

    /**
     * アニメ詳細
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Anime $anime)
    {
        $title = '【Holy Place Photo】アニメ「' . $anime->name . ' 」の聖地の写真の一覧';
        $description = 'アニメ「' . $anime->name . '」の聖地の写真の一覧です。気になる聖地の写真を選んでみましょう。【Holy Place Photo】はアニメの聖地の写真の共有サイトです。';

        $googleAdsense = true;
        return view('anime.show', compact('anime', 'title', 'description', 'googleAdsense'));
    }
}
