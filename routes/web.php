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
Route::get('denied', ['as'=>'denied', 'uses' => 'PagesController@getDenied']);
Route::get('/', 'PagesController@getHome');
Route::get('blog', 'PagesController@getBlog');
Route::get('explore', 'PagesController@getExplore');
//Route for the auth-related features
Auth::routes();
Route::get('/home', 'HomeController@index');
//Route for Projects CRUD
Route::get('starred-projects', ['as' => 'starred.projects', 'uses' => 'ProjectController@getStarred']);
Route::resource('project', 'ProjectController', ['except' => ['show', 'edit', 'update', 'destroy']]);
Route::group(['middleware' => 'ProjectAccess'], function(){
	Route::get('project/{id}', ['as' => 'project.show', 'uses' => 'ProjectController@show']);
	Route::get('project/{id}/edit', ['as' => 'project.edit', 'uses' => 'ProjectController@edit']);
	Route::put('project/{id}', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
	Route::delete('project/{id}', ['as' => 'project.destroy', 'uses' => 'ProjectController@destroy']);
});
//Route for dashboard
Route::group(['prefix' => 'profile'], function(){
	//Route for Company Profile
	Route::get('dashboard', ['as' => 'profile.dashboard', 'uses' => 'ProfileController@getDashboard']);
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
	Route::get('invite/show_sender/{id}', ['as' => 'invite.show_sender', 'uses' => 'SenderActionController@getShowSender']);
	Route::put('invite/remove_for_sender/{id}', ['as' => 'invite.remove_for_sender', 'uses' => 'SenderActionController@putRemove']); 
	Route::post('invite/sender_comment/{id}', ['as' => 'invite.sender_comment', 'uses' => 'SenderActionController@postSenderComment']);
});
Route::group(['middleware' => 'receiverInviteAccess'], function(){
	Route::get('invite/show_receiver/{id}', ['as' => 'invite.show_receiver', 'uses' => 'ReceiverActionController@getShowReceiver']);
	Route::put('invite/check/{id}', ['as' => 'invite.checked', 'uses' => 'ReceiverActionController@putChecked']);
	Route::put('invite/accept/{id}', ['as' => 'invite.accepted', 'uses' => 'ReceiverActionController@putAccepted']);
	Route::put('invite/reject/{id}', ['as' => 'invite.rejected', 'uses' => 'ReceiverActionController@putRejected']);
	//Route for comment byt receiver
	Route::post('invite/receiver_comment/{id}', ['as' => 'invite.receiver_comment', 'uses' => 'ReceiverActionController@postReceiverComment']);
});
Route::get('invite/denied', ['as' => 'invite.denied', 'uses' => 'InviteController@getDenied']);
Route::get('invite/sent', ['as' => 'invite.sent', 'uses' => 'InviteController@getSent']);
Route::get('invite/received', ['as' => 'invite.received', 'uses' => 'InviteController@getReceived']);
Route::put('invite/remove_for_receiver/{id}', ['as' => 'invite.remove_for_receiver', 'uses' => 'ReceiverActionController@putRemove']); 
Route::get('invite/notify', ['as' => 'invite.notify', 'uses' => 'InviteController@getNotify']); //This comes first
Route::resource('invite', 'InviteController');//This comes last, the rest of invite/ comes before. only then it works.
//Route for explore
Route::get('explore/search', ['as' => 'explore.search', 'uses' => 'ExploreController@getSearch']);
Route::get('explore/search/result', ['as' => 'explore.result', 'uses' => 'ExploreController@getResult']);
Route::get('explore/search/show_user', ['as' => 'explore.show_user', 'uses' => 'ExploreController@getUser']);
Route::get('explore/projects/index', ['as' => 'explore.project_index', 'uses' => 'ExploreController@getProjectIndex']);
Route::get('explore/projects/show/{id}', ['as' => 'explore.project_show', 'uses' => 'ExploreController@getProjectShow']);