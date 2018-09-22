<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Photo extends Model
{
    protected $fillable = ['name', 'title', 'comment', 'user_id', 'anime_id', 'password', 'lat', 'lng'];

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

    public function likeDone($id)
    {
        return $this->like()->where('user_id', $id)->first();
    }
}
