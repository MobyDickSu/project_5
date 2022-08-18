<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function()
{
    // 表單
    Route::get('posts/admin', 'PostController@admin');
    Route::get('/posts/create', 'PostController@create');
    Route::get('/posts/{post}/edit', 'PostController@edit');
    // 動作
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/show/{post}', 'PostController@showByAdmin');
    Route::put('/posts/{post}', 'PostController@update');
    Route::delete('/posts/{post}', 'PostController@destroy');
    Route::resource('category', 'CategoryController')->except(['show']);
    Route::resource('tags', 'TagController')->only(['index', 'destroy']);
});

Route::resource('comments', 'CommentController')->only(['store', 'update', 'destroy']);

Route::get('/posts', 'PostController@index');
Route::get('/posts/category/{category}', 'PostController@indexWithCategory');
Route::get('/posts/tag/{tag}', 'PostController@indexWithTag');

Route::get('/posts/{post}', 'PostController@show');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
