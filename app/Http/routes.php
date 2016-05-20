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

Route::group(['prefix' => 'categorias'], function () {
    Route::get('/', 'CategoriaController@index');

    Route::get('/novo','CategoriaController@create');
    Route::post('/novo', 'CategoriaController@store');

    Route::get('/editar/{categoria}', 'CategoriaController@edit');
    Route::put('/editar/{categoria}', 'CategoriaController@update');

    Route::delete('/{categoria}', 'CategoriaController@destroy');
});

Route::auth();

Route::get('/home', 'HomeController@index');
