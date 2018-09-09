<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Like;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function like(Request $request, $id)
    {
        $like = Like::where('user_id', $request->session()->get('userId'))->where('photo_id', $id)->first();
        if($like) {
            $like->delete();
            return response('delete');
        }
        $like = new Like();
        $like->user_id = $request->session()->get('userId');
        $like->photo_id = $id;
        $like->save();
        return response('ok');
    }
}
