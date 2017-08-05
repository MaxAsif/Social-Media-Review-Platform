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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/{group_id}/facebook', 'FbAuth\LoginController@redirectToProvider');
Route::get('login/facebook/callback/{provider?}', 'FbAuth\LoginController@handleProviderCallback');
Route::get('callback/{provider?}', 'FbAuth\LoginController@handleCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Facebook', 'middleware' => ['auth', 'admin']], function() {
	Route::resource('/pages', 'PageController');
	Route::resource('/pages.posts', 'PostController');
	Route::resource('/facebook-posts.activity', 'ActivityController');

});

Route::group(['namespace' => 'Twitter', 'middleware' => ['auth', 'admin']], function() {
	Route::resource('/twitter-posts.activity', 'HandleActivityController');
	Route::get('/handles/{handle_id}/activity', 'HandleActivityController@showUserActivity');
	Route::resource('/handles', 'HandleController');
	Route::resource('/handles.posts', 'HandlePostController');
	Route::resource('/hashtags', 'HashtagController');
	Route::get('/handles/{id}/delete', 'HandleController@destroy');
	Route::get('/hashtags/{id}/delete', 'HashtagController@destroy');
});

Route::get('{any}', function() {
	return view('layouts.error');
});
