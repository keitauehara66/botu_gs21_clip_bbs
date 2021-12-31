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
Route::get('/', 'ThreadController@index')->name('threads.index'); // indexに名前をつけた
Route::resource('/threads', 'ThreadController')->except(['index'])->middleware('auth');
Route::resource('/comments', 'CommentController')->middleware('auth');
// indexは1つ上と重複するのでresourceで生成されるルーティングから除外する
// middleware('auth')を入れることで、ログインしていないとパス自体が有効にならない設定になる（アドレス直打ちでもアクセスできない）
// 後でこのミドルウェアを他のパスにも適用する！！！！！
Route::prefix('threads')->name('threads.')->group(function () {
    Route::put('/{thread}/bookmark', 'ThreadController@bookmark')->name('bookmark')->middleware('auth');
    Route::delete('/{thread}/bookmark', 'ThreadController@unbookmark')->name('unbookmark')->middleware('auth');
});
Route::get('/tags/{tagname}', 'TagController@show')->name('tags.show');
Route::prefix('comments')->name('comments.')->group(function () {
    Route::put('/{comment}/like', 'CommentController@like')->name('like')->middleware('auth');
    Route::delete('/{comment}/like', 'CommentController@unlike')->name('unlike')->middleware('auth');
});
