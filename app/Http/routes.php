<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('auth/register.json', 'UserController@register');
Route::post('auth/login.json', 'UserController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
		Route::group(['prefix'=>'api'], function(){
			Route::get('/user', 'UserController@getAuthUser');
			#Route::resource('api/note','NoteController');
			Route::get('/note.json','NoteController@index');
			Route::post('/create_note.json','NoteController@store');
			Route::post('/delete.json','NoteController@destroy');
			Route::post('/update.json','NoteController@update');
		});
});
