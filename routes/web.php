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
//Route for Static pages
Route::get('/', 'PagesController@getHome');
Route::get('blog', 'PagesController@getBlog');
Route::get('explore', 'PagesController@getExplore');
//Route for the auth-related features
Auth::routes();
//Route for Projects CRUD
Route::resource('project', 'ProjectController', ['except' => ['index']]);
Route::group(['prefix' => 'profile'], function(){
	//Route for Company Profile
	Route::get('dashboard', 'ProfileController@getDashboard');
	//Route for Project CRUD
	Route::get('projects', 'ProjectController@index');
});
Route::get('/home', 'HomeController@index');