<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Photo extends Model
{
    protected $fillable = ['name', 'title', 'comment', 'user_id', 'anime_id', 'password', 'lat', 'lng', 'shooting_date'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function urls() {
        return $this->hasMany('App\Model\PhotoUrl');
    }

    public function anime() {
        return $this->belongsTo('App\Model\Anime');
    }

    public function scopeAnime($query, $animeId)
    {
        return $query->whereHas('anime', function ($query) use ($animeId) {
            $query->where('id', $animeId);
        });
    }

    public function like() {
        return $this->hasMany('App\Model\Like');
    }

    public function getLikeCountAttribute()
    {
        return $this->like()->count();
    }

    public function getAnimeNameAttribute()
    {
        return $this->anime()->first()->name;
    }

    public function getFormatShootingDateAttribute()
    {
        return Carbon::parse($this->shooting_date)->format('Y年m月d日');
    }

    public function likeDone($id)
    {
        return $this->like()->where('user_id', $id)->first();
    }

    public function getFirstPhotoUrlAttribute()
    {
        return $this->urls()->first()->full_url;
    }

    public function getUrlAttribute()
    {
        return action('PhotoController@show', $this->id);
    }
}
