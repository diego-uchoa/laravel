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

//ROTAS ABERTAS
Route::get('lista-telefonica', ['prefix' => 'sisfone', 'as' => 'sisfone::lista-telefonica', 'uses' => 'TelefoneController@listaTelefonica']);
Route::get('lista-telefonica-pdf', ['prefix' => 'sisfone', 'as' => 'sisfone::lista-telefonica-pdf', 'uses' => 'TelefoneController@listaTelefonicaPDF']);

Route::group(['prefix' => 'sisfone', 'middleware' =>  ['aviso','menu','auth']], function() {
   
   //INÍCIO
   Route::get('/', ['middleware' => ['permission:sisfone::inicio'],'as' => 'sisfone::inicio', 'uses' => 'SisfoneController@index']);

   //TELEFONE
   Route::get('telefone', [ 'middleware' => ['permission:sisfone::telefone.index'],'as' => 'sisfone::telefone.index', 'uses' => 'TelefoneController@index']);
   Route::get('telefone/new', ['middleware' => ['permission:sisfone::telefone.create'],'as' => 'sisfone::telefone.create', 'uses' => 'TelefoneController@create']);
   Route::post('telefone/store', ['middleware' => ['permission:sisfone::telefone.store'],'as' => 'sisfone::telefone.store', 'uses' => 'TelefoneController@store']);
   Route::get('telefone/edit/{id}', ['middleware' => ['permission:sisfone::telefone.edit'],'as' => 'sisfone::telefone.edit', 'uses' => 'TelefoneController@edit']);
   Route::put('telefone/update/{id}', ['middleware' => ['permission:sisfone::telefone.update'],'as' => 'sisfone::telefone.update', 'uses' => 'TelefoneController@update']);
   Route::delete('telefone/destroy/{id}', ['middleware' => ['permission:sisfone::telefone.destroy'],'as' => 'sisfone::telefone.destroy', 'uses' => 'TelefoneController@destroy']);
});
