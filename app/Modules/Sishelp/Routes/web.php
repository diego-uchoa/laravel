<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('ajuda_sistema/{sistema}', ['prefix' => 'sishelp', 'as' => 'sishelp::ajuda_sistema.index', 'uses' => 'AjudaSistemaController@index']);

Route::group(['prefix' => 'sishelp', 'middleware' => ['aviso','menu','auth']], function() {
    
    //Página Padrão
    //Route::get('/', 'SishelpController@index');
    Route::get('/', ['middleware' => ['permission:sishelp::inicio'], 'as' => 'sishelp::inicio', 'uses' => 'SishelpController@index']);

    //AJUDA FAQ
    Route::get('ajuda_faq', ['middleware' => ['permission:sishelp::ajuda_faq.index'], 'as' => 'sishelp::ajuda_faq.index', 'uses' => 'AjudaFaqController@index']);
    Route::get('ajuda_faq/new', ['middleware' => ['permission:sishelp::ajuda_faq.index'], 'as' => 'sishelp::ajuda_faq.create', 'uses' => 'AjudaFaqController@create']);
    Route::post('ajuda_faq/store', ['middleware' => ['permission:sishelp::ajuda_faq.index'], 'as' => 'sishelp::ajuda_faq.store', 'uses' => 'AjudaFaqController@store']);
    Route::get('ajuda_faq/edit/{id}', ['middleware' => ['permission:sishelp::ajuda_faq.index'], 'as' => 'sishelp::ajuda_faq.edit', 'uses' => 'AjudaFaqController@edit']);
    Route::put('ajuda_faq/update/{id}', ['middleware' => ['permission:sishelp::ajuda_faq.index'],'as' => 'sishelp::ajuda_faq.update', 'uses' => 'AjudaFaqController@update']);
    Route::get('ajuda_faq/destroy/{id}', ['middleware' => ['permission:sishelp::ajuda_faq.index'], 'as' => 'sishelp::ajuda_faq.destroy', 'uses' => 'AjudaFaqController@destroy']);

    //AJUDA ARQUIVO
    Route::get('ajuda_arquivo', ['middleware' => ['permission:sishelp::ajuda_arquivo.index'],'as' => 'sishelp::ajuda_arquivo.index', 'uses' => 'AjudaArquivoController@index']);
    Route::get('ajuda_arquivo/new', ['middleware' => ['permission:sishelp::ajuda_arquivo.index'],'as' => 'sishelp::ajuda_arquivo.create', 'uses' => 'AjudaArquivoController@create']);
    Route::post('ajuda_arquivo/store', ['middleware' => ['permission:sishelp::ajuda_arquivo.index'],'as' => 'sishelp::ajuda_arquivo.store', 'uses' => 'AjudaArquivoController@store']);
    Route::get('ajuda_arquivo/edit/{id}', ['middleware' => ['permission:sishelp::ajuda_arquivo.index'],'as' => 'sishelp::ajuda_arquivo.edit', 'uses' => 'AjudaArquivoController@edit']);
    Route::put('ajuda_arquivo/update/{id}', ['middleware' => ['permission:sishelp::ajuda_arquivo.index'],'as' => 'sishelp::ajuda_arquivo.update', 'uses' => 'AjudaArquivoController@update']);
    Route::get('ajuda_arquivo/destroy/{id}', ['middleware' => ['permission:sishelp::ajuda_arquivo.index'],'as' => 'sishelp::ajuda_arquivo.destroy', 'uses' => 'AjudaArquivoController@destroy']);

    //AJUDA GERAL
    Route::get('ajuda_geral', ['middleware' => ['permission:sishelp::ajuda_geral.index'],'as' => 'sishelp::ajuda_geral.index', 'uses' => 'AjudaGeralController@index']);
    Route::get('ajuda_geral/new', ['middleware' => ['permission:sishelp::ajuda_geral.index'],'as' => 'sishelp::ajuda_geral.create', 'uses' => 'AjudaGeralController@create']);
    Route::post('ajuda_geral/store', ['middleware' => ['permission:sishelp::ajuda_geral.index'],'as' => 'sishelp::ajuda_geral.store', 'uses' => 'AjudaGeralController@store']);
    Route::get('ajuda_geral/edit/{id}', ['middleware' => ['permission:sishelp::ajuda_geral.index'],'as' => 'sishelp::ajuda_geral.edit', 'uses' => 'AjudaGeralController@edit']);
    Route::put('ajuda_geral/update/{id}', ['middleware' => ['permission:sishelp::ajuda_geral.index'],'as' => 'sishelp::ajuda_geral.update', 'uses' => 'AjudaGeralController@update']);
    Route::get('ajuda_geral/destroy/{id}', ['middleware' => ['permission:sishelp::ajuda_geral.index'],'as' => 'sishelp::ajuda_geral.destroy', 'uses' => 'AjudaGeralController@destroy']);

});
