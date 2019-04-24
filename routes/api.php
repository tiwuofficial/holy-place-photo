<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'login'], function () {
    Route::post('/photos/{id}/like', 'Api\PhotoController@like')->where('id', '[0-9]+');
    Route::get('/photos', 'Api\PhotoController@readMore');
    Route::get('/photos/get/anime/{id}', 'Api\PhotoController@getPhotosByAnime');
    Route::get('/anime/get', 'Api\AnimeController@get');
    Route::get('/anime/get/old', 'Api\AnimeController@getOld');
    Route::get('/anime/get/havePhoto', 'Api\AnimeController@getForHavePhoto');
    Route::get('/anime/get/noHavePhoto', 'Api\AnimeController@getForNoHavePhoto');
});
