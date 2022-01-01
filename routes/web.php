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

Auth::routes();
Route::get('/', 'ThreadController@index')->name('threads.index')->middleware('auth'); // indexに名前をつけた
Route::prefix('threads')->name('threads.')->group(function () {
    Route::put('/{thread}/bookmark', 'ThreadController@bookmark')->name('bookmark')->middleware('auth');
    Route::delete('/{thread}/bookmark', 'ThreadController@unbookmark')->name('unbookmark')->middleware('auth');
});
Route::get('/tags/{tagname}', 'TagController@show')->name('tags.show')->middleware('auth');
Route::prefix('comments')->name('comments.')->group(function () {
    Route::put('/{comment}/like', 'CommentController@like')->name('like')->middleware('auth');
    Route::delete('/{comment}/like', 'CommentController@unlike')->name('unlike')->middleware('auth');
});
Route::get('/threads/search', 'ThreadController@search')->name('threads.search')->middleware('auth');
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/bookmarks', 'UserController@bookmarks')->name('bookmarks');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});
Route::resource('/threads', 'ThreadController')->except(['index'])->middleware('auth');
Route::resource('/comments', 'CommentController')->middleware('auth');
// indexは1つ上と重複するのでresourceで生成されるルーティングから除外する
// middleware('auth')を入れることで、ログインしていないとパス自体が有効にならない設定になる（アドレス直打ちでもアクセスできない）
// 後でこのミドルウェアを他のパスにも適用する！！！！！
