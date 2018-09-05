<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name', 'title', 'comment', 'user_id', 'anime_id'];

    public function urls() {
        return $this->hasMany('App\Model\PhotoUrl');
    }

    public function anime() {
        return $this->belongsTo('App\Model\Anime');
    }
}
