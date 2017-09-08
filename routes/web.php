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

Route::get('/', function () {
    //$users_ids=App\User::pluck('id')->toArray();
    $discussion_ids=App\Discussion::pluck('id')->toArray();
    return $discussion_ids;
   // return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/index', 'PostsController@index');
Route::post('/posts/upload', 'PostsController@upload');
Route::get('/user/register', 'UsersController@register');
Route::get('/user/login', 'UsersController@login');
//头像
Route::get('/user/avatar', 'UsersController@avatar');
Route::post('/avatar/change', 'UsersController@changeAvatar');
Route::post('/crop/api', 'UsersController@cropAvatar');


Route::post('/user/login', 'UsersController@signin');
Route::post('/user/register', 'UsersController@store');
Route::get('/verify/{confirm_code}', 'UsersController@confirmEmail');
Route::get('/logout', 'UsersController@logout');
Route::resource('discussions','PostsController');
Route::resource('comments','CommentsController');

Route::post('/discussions/update/{id}','PostsController@update');

