<?php

namespace App\Http\Controllers;

use App\Model\Anime;
use App\Model\Photo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class siteMapController extends Controller
{
    public function sitemap(){
        $sitemap = App::make("sitemap");
        $now = Carbon::now();
        $sitemap->add(URL::to('/'), $now, '1.0', 'always');
        $sitemap->add(URL::to('/photos/create'), '2018-10-28', '1.0', 'monthly');
        $sitemap->add(URL::to('/anime'), '2018-10-28', '1.0', 'monthly');
        $sitemap->add(URL::to('/inquiry'), '2018-10-28', '0.3', 'yearly');
        $sitemap->add(URL::to('/about'), '2018-10-28', '0.7', 'monthly');
        $sitemap->add(URL::to('/kiyaku'), '2018-10-28', '0.3', 'yearly');
        $sitemap->add(URL::to('/privacy'), '2018-10-28', '0.3', 'yearly');

        $photos = Photo::orderBy('updated_at', 'desc')->get();
        foreach ($photos as $photo)
        {
            $sitemap->add(URL::to('/photos/' . $photo->id), $photo->updated_at, '0.8', 'yearly');
            $sitemap->add(URL::to('/amp/photos/' . $photo->id), $photo->updated_at, '0.8', 'yearly');
        }

        $animes = Anime::orderBy('updated_at', 'desc')->get();
        foreach ($animes as $anime)
        {
            $sitemap->add(URL::to('/anime/' . $anime->id), $anime->updated_at, '0.8', 'yearly');
        }
        return $sitemap->render('xml');
    }
}
