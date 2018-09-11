<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'login'], function () {

    // トップ
    Route::get('/', 'TopController@index');

    // 写真詳細
    Route::get('/photos/{id}', 'PhotoController@show')->where('id', '[0-9]+');

    // 写真投稿
    Route::get('/photos/create', 'PhotoController@create');
    Route::post('/photos', 'PhotoController@store');

    // 写真編集
    Route::get('/photos/{photo}/edit', 'PhotoController@edit')->where('photo', '[0-9]+');
    Route::put('/photos/{photo}', 'PhotoController@update')->where('photo', '[0-9]+');

    // 写真削除
    Route::delete('/photos/{photo}', 'PhotoController@destory')->where('photo', '[0-9]+');

    // アニメ一覧
    Route::get('/anime', 'AnimeController@index');

    // アニメ詳細
    Route::get('/anime/{anime}', 'AnimeController@show')->where('anime', '[0-9]+');

    // ユーザー詳細
    Route::get('/users/{id}', 'UserController@show')->where('id', '[0-9]+');

    // 問い合わせ
    Route::get('/inquiry', 'TopController@inquiry');
    Route::post('/inquiry', 'TopController@inquiryStore');

    // ガイドライン
    Route::get('/guide', 'TopController@guide');

    // サイトについて
    Route::get('/about', 'TopController@about');
});