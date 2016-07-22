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

    if (Auth::check()) {
        return redirect('/vendas');
    }

    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function(){

    Route::group(['prefix' => 'categorias'], function () {
        Route::get('/', 'CategoriaController@index');

        Route::get('/novo','CategoriaController@create');
        Route::post('/novo', 'CategoriaController@store');

        Route::get('/editar/{categoria}', 'CategoriaController@edit');
        Route::put('/editar/{categoria}', 'CategoriaController@update');

        Route::delete('/{categoria}', 'CategoriaController@destroy');
    });

    Route::group(['prefix' => 'produtos'], function () {
        Route::get('/', 'ProdutosController@index');

        Route::get('/novo','ProdutosController@create');
        Route::post('/novo', 'ProdutosController@store');

        Route::get('/editar/{produto}', 'ProdutosController@edit');
        Route::put('/editar/{produto}', 'ProdutosController@update');

        Route::delete('/{produto}', 'ProdutosController@destroy');
    });

    Route::group(['prefix' => 'vendas'], function () {
        Route::get('/', 'VendaController@index');
        Route::post('/addproduto', 'VendaController@addProduto');
        Route::post('/finalizar', 'VendaController@finalizar');
        Route::delete('/item/{item}', 'VendaController@removeItem');
        Route::delete('/', 'VendaController@cancelaVenda');
    });

    Route::group(['prefix' => 'estoque'], function () {
        Route::get('/', 'EstoqueController@index');
    });
});

Route::auth();
