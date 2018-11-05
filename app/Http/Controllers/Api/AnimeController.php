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
}
