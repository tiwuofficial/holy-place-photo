<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhotoUrl extends Model
{
    protected $fillable = ['name', 'title', 'comment', 'user_id', 'anime_id'];

    protected $appends = ['full_url'];

    public function getFullUrlAttribute()
    {
        return env('AWS_S3_URL') . $this->url;
    }
}
