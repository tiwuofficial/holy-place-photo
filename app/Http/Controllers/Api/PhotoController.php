<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Like;
use App\Model\Photo;
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

    public function readMore(Request $request)
    {
        $photos = Photo::with('urls', 'anime')->orderBy('created_at', 'desc')->paginate((int) $request->input('perPage', 3));
        $result = [];
        foreach ($photos as $photo) {
            $result[] = [
                'url' => $photo->url,
                'title' => $photo->title,
                'animeName' => $photo->anime_name,
                'photoUrl' => $photo->first_photo_url
            ];
        }
        return response()->json($result);
    }

    public function getByPhoto($id)
    {
        $photo = Photo::with('urls', 'anime')->where('id', $id)->first();
        $result = [
            'url' => $photo->url,
            'title' => $photo->title,
            'animeName' => $photo->anime_name,
            'animeUrl' => action('AnimeController@show', $photo->anime->id, false),
            'shootingDate' => $photo->shooting_date,
            'userUrl' => action('UserController@show', $photo->user_id, false),
            'userName' => $photo->name,
            'comment' => $photo->comment,
            'createdAt' => $photo->created_at,
            'editUrl' => action('PhotoController@edit', $photo->id, false),
            'lat' => $photo->lat,
            'lng' => $photo->lng,
            'photoId' => $photo->id,
            'likeCount' => $photo->likeCount,
            'userId' => $photo->user_id,
            'animeId' => $photo->anime->id,
            'photoUrls' => $photo->urls
        ];
        return response()->json($result);
    }

    public function getPhotosByAnime($id)
    {
        $photos = Photo::with('urls', 'anime')->anime($id)->orderBy('created_at', 'desc')->get();
        $result = [];
        foreach ($photos as $photo) {
            $result[] = [
                'url' => $photo->url,
                'title' => $photo->title,
                'animeName' => $photo->anime_name,
                'photoUrl' => $photo->first_photo_url
            ];
        }
        return response()->json($result);
    }

    public function getPhotosByUser($id)
    {
        $photos = Photo::where('user_id', $id)->with('urls', 'anime')->orderBy('created_at', 'desc')->get();
        $result = [];
        foreach ($photos as $photo) {
            $result[] = [
                'url' => $photo->url,
                'title' => $photo->title,
                'animeName' => $photo->anime_name,
                'photoUrl' => $photo->first_photo_url
            ];
        }
        return response()->json($result);
    }
}
