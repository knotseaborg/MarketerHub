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
Route::get('/home', 'HomeController@index');
//Route for Projects CRUD
Route::resource('project', 'ProjectController');
Route::group(['prefix' => 'profile'], function(){
	//Route for Company Profile
	Route::get('dashboard', ['as' => 'profile.dashboard', 'uses' => 'ProfileController@getDashboard']);
	//Route for Project CRUD
	Route::get('projects', ['as' => 'profile.projects', 'uses' => 'ProfileController@getProjects']);
});
//Route for category Type
Route::resource('category_type', 'CategoryTypeController');
Route::get('category_type/delete/{id}', ['as' => 'category_type.delete', 'uses' => 'CategoryTypeController@delete']);
//Route for categories
Route::resource('category', 'CategoryController');
Route::get('category/delete/{id}', ['as' => 'category.delete', 'uses' => 'CategoryController@delete']);