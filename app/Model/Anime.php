<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{

    public function photos()
    {
        return $this->hasMany('App\Model\Photo');
    }

    public function getPhotoCountAttribute()
    {
        return $this->photos()->count();
    }

    public function getUrlAttribute()
    {
        return action('AnimeController@show', $this->id);
    }
}
