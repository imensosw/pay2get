<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/','UsersController@create');
Route::get('/users','UsersController@index');
Route::get('/users/create','UsersController@create');
Route::post('/users/save',['uses' => 'UsersController@save']);

Route::get('/users/profile','UsersController@profile');

Route::get('/users/download', 'UsersController@getDownload');


