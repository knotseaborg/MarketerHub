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
Route::get('starred-projects', ['as' => 'starred.projects', 'uses' => 'ProjectController@getStarred']);
Route::group(['prefix' => 'profile'], function(){
	//Route for Company Profile
	Route::get('dashboard', ['as' => 'profile.dashboard', 'uses' => 'ProfileController@getDashboard']);
	//Route for Project CRUD
	//Route::get('projects', ['as' => 'profile.projects', 'uses' => 'ProfileController@getProjects']);
});
//Route for category Type
Route::resource('category_type', 'CategoryTypeController');
Route::get('category_type/delete/{id}', ['as' => 'category_type.delete', 'uses' => 'CategoryTypeController@delete']);
//Route for categories
Route::resource('category', 'CategoryController');
Route::get('category/delete/{id}', ['as' => 'category.delete', 'uses' => 'CategoryController@delete']);
//Route for settings
Route::resource('setting', 'SettingsController', ['except' => ['create', 'edit', 'update', 'show', 'destroy']]);
Route::put('setting', ['as' => 'setting.update', 'uses' => 'SettingsController@update']);
//Route for tags
Route::resource('tag', 'TagController');
//Route for Invitations
Route::group(['middleware' => 'senderInviteAccess'], function(){
	Route::get('invite/show_sender/{id}', ['as' => 'invite.show_receiver', 'uses' => 'SenderActionController@getShowSender']);
	Route::put('invite/remove_for_sender/{id}', ['as' => 'invite.remove_for_sender', 'uses' => 'SenderActionController@putRemove']); 
});
Route::group(['middleware' => 'receiverInviteAccess'], function(){
	Route::get('invite/show_receiver/{id}', ['as' => 'invite.show_receiver', 'uses' => 'ReceiverActionController@getShowReceiver']);
	Route::put('invite/check/{id}', ['as' => 'invite.checked', 'uses' => 'ReceiverActionController@putChecked']);
	Route::put('invite/accept/{id}', ['as' => 'invite.accepted', 'uses' => 'ReceiverActionController@putAccepted']);
	Route::put('invite/reject/{id}', ['as' => 'invite.rejected', 'uses' => 'ReceiverActionController@putRejected']);
});
Route::get('invite/denied', ['as' => 'invite.denied', 'uses' => 'InviteController@getDenied']);
Route::get('invite/sent', ['as' => 'invite.sent', 'uses' => 'InviteController@getSent']);
Route::get('invite/received', ['as' => 'invite.received', 'uses' => 'InviteController@getReceived']);
Route::put('invite/remove_for_receiver/{id}', ['as' => 'invite.remove_for_receiver', 'uses' => 'ReceiverActionController@putRemove']); 
Route::get('invite/notify', ['as' => 'invite.notify', 'uses' => 'InviteController@getNotify']); //This comes first
Route::resource('invite', 'InviteController');//This comes last, the rest of invite/ comes before. only then it works.
//Route for Comments for Invites
Route::resource('comment', 'CommentsController');