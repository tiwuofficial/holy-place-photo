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

Route::group(['middleware' => ['sw.cache']], function () {

    // トップ
    Route::get('/', 'TopController@index');


    Route::prefix('photos')->group(function () {
        // 写真詳細
        Route::get('/{photo}', 'PhotoController@show')->where('photo', '[0-9]+');

        // 写真投稿
        Route::get('/create', 'PhotoController@create');
        Route::post('/', 'PhotoController@store');

        Route::get('/camera', 'PhotoController@camera');


        // 写真編集
        Route::post('/{photo}/edit', 'PhotoController@edit')->where('photo', '[0-9]+');
        Route::put('/{photo}', 'PhotoController@update')->where('photo', '[0-9]+');

        // 写真削除
        Route::delete('/{photo}', 'PhotoController@destroy')->where('photo', '[0-9]+');
    });

    Route::prefix('anime')->group(function () {
        // アニメ一覧
        Route::get('/', 'AnimeController@index');

        // アニメ詳細
        Route::get('/{anime}', 'AnimeController@show')->where('anime', '[0-9]+');
    });

    // ユーザー詳細
    Route::get('/users/{user}', 'UserController@show')->where('user', '[0-9]+');

    // 問い合わせ
    Route::get('/inquiry', 'TopController@inquiry');
    Route::post('/inquiry', 'TopController@inquiryStore');

    // サイトについて
    Route::get('/about', 'TopController@about');

    // 利用規約
    Route::get('/kiyaku', 'TopController@kiyaku');

    // プライバシーポリシー
    Route::get('/privacy', 'TopController@privacy');

    // twitter login
    Route::get('auth/twitter', 'Auth\TwitterController@redirectToProvider');
    Route::get('auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback');
    Route::get('auth/twitter/logout', 'Auth\TwitterController@logout');
});

Route::get('/sitemap', 'SiteMapController@sitemap');

// AMP
Route::prefix('amp')->group(function () {
    Route::prefix('photos')->group(function () {
        // 写真詳細
        Route::get('/{photo}', 'PhotoController@showAmp')->where('photo', '[0-9]+');
    });
    Route::get('/story', 'TopController@story');
});