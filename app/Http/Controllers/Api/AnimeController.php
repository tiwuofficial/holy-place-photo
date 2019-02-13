<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Anime;
use Illuminate\Support\Facades\Redis;

class AnimeController extends Controller
{
    public function get()
    {
        return response()->json(Redis::hGetAll('anime'));
    }

    public function getOld()
    {
        return response()->json(Anime::all());
    }

    public function getForHavePhoto()
    {
        $animes = Anime::has('photos')->with('photos')->get();
        $result = [];
        foreach ($animes as $anime) {
            $result[] = [
                'id' => $anime->id,
                'name' => $anime->name,
                'photoCount' => $anime->photoCount
            ];
        }
        return response()->json($result);
    }

    public function getForNoHavePhoto()
    {
        $animes = Anime::has('photos', '=', 0)->get();
        $result = [];
        foreach ($animes as $anime) {
            $result[$anime->id] = $anime->name;
        }
        return response()->json($result);
    }
}
