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

Route::post('auth/register', 'UserController@register');
Route::post('auth/login', 'UserController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
		Route::get('api/user', 'UserController@getAuthUser');
		#Route::resource('api/note','NoteController');
		Route::get('api/note.json','NoteController@index');
		Route::post('api/create_note.json','NoteController@store');
		Route::post('api/delete.json','NoteController@destroy');
});
