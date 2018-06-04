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
   return view('welcome');
});

Route::get('/test/{parametr}', 'TestController@index');

Route::get('/search', 'SearchController@users');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users','UsersController',['except' => ['index','create','store','destroy']]);

Route::get('/user-avatar/{id}/{size}','ImagesController@user_avatar');

Route::get('/users/{user}/friends','FriendsController@index');
Route::post('/friends/{friend}','FriendsController@add');
Route::patch('/friends/{friend}','FriendsController@accept');
Route::delete('/friends/{friend}','FriendsController@destroy');

Route::resource('/posts','PostsController',['except' => ['index','create']]);

Route::get('/wall','WallsController@index');

Route::resource('/comments', 'CommentController',['except' => ['index','create','show']]);

Route::post('/likes','LikesController@add');
Route::delete('/likes','LikesController@destroy');

Route::get('/notifications','NotificationsController@index');

Route::patch('/notifications/{notification}','NotificationsController@update');

