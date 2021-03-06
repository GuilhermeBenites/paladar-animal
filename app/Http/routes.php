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
        Route::post('/addgranel', 'VendaController@addGRanel');
        Route::post('/finalizar', 'VendaController@finalizar');
        Route::delete('/item/{item}', 'VendaController@removeItem');
        Route::delete('/', 'VendaController@cancelaVenda');

        Route::get('/vendas-do-dia', 'VendaController@vendasDoDia');

        Route::get('/vendas-do-dia-pesquisa', 'VendaController@vendasDoDiaPesquisa');
    });

    Route::group(['prefix' => 'estoque'], function () {
        Route::get('/', 'EstoqueController@index');
        Route::get('/entrada', 'EstoqueController@create');
        Route::post('/entrada', 'EstoqueController@store');
        Route::get('/informar', 'EstoqueController@informar');
        Route::post('/informar', 'EstoqueController@atualizar');

    });

    Route::group(['prefix' => 'movimentacao'], function () {
        Route::get('/', 'MovimentacaoController@index');
    });

    Route::group(['prefix' => 'granel'], function () {
        Route::get('/', 'GranelController@index');
        Route::get('/novo', 'GranelController@create');
        Route::post('/novo', 'GranelController@store');
        Route::get('/abrir', 'GranelController@abrirSacoForm');
        Route::post('/abrir', 'GranelController@abrirSacoSalvar');

        Route::get('/informar', 'GranelController@informar');
        Route::post('/informar', 'GranelController@atualizar');
    });
});

Route::auth();
