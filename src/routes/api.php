<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

Route::get('lista-produtos', 'ProdutoController@index');
Route::group(['prefix' => 'produto'], function () {
    Route::post('adicionar', 'ProdutoController@add');
    Route::get('editar/{id}', 'ProdutoController@edit');
    Route::post('update/{id}', 'ProdutoController@update');
    Route::delete('deletar/{id}', 'ProdutoController@delete');
});

Route::get('lista-transacoes', 'TransacaoController@index');
Route::group(['prefix' => 'transacao'], function () {
    Route::post('adicionar', 'TransacaoController@add');
    Route::get('editar/{id}', 'TransacaoController@edit');
    Route::post('update/{id}', 'TransacaoController@update');
    Route::delete('deletar/{id}', 'TransacaoController@delete');
});


