<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PhotoUrl extends Model
{
    protected $fillable = ['name', 'title', 'comment', 'user_id', 'anime_id'];
}
