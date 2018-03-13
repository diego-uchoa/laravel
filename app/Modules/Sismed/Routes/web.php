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

Route::group(['prefix' => 'sismed', 'middleware' =>  ['aviso','menu','auth']], function() {
   
   //INÍCIO
   Route::get('/', ['middleware' => ['permission:sismed::inicio'],'as' => 'sismed::inicio', 'uses' => 'SismedController@index']);

   //SERVIDOR
   Route::get('servidor', ['middleware' => ['permission:sismed::servidor.index'],'as' => 'sismed::servidor.index', 'uses' => 'ServidorController@index']);
   Route::get('servidor/new', ['middleware' => ['permission:sismed::servidor.create'],'as' => 'sismed::servidor.create', 'uses' => 'ServidorController@create']);
   Route::post('servidor/store', ['middleware' => ['permission:sismed::servidor.store'],'as' => 'sismed::servidor.store', 'uses' => 'ServidorController@store']);
   Route::get('servidor/edit/{id}', ['middleware' => ['permission:sismed::servidor.edit'],'as' => 'sismed::servidor.edit', 'uses' => 'ServidorController@edit']);
   Route::put('servidor/update/{id}', ['middleware' => ['permission:sismed::servidor.update'],'as' => 'sismed::servidor.update', 'uses' => 'ServidorController@update']);
   Route::get('servidor/destroy/{id}', ['middleware' => ['permission:sismed::servidor.destroy'],'as' => 'sismed::servidor.destroy', 'uses' => 'ServidorController@destroy']);
   Route::get('servidor/{id}/atestados/', ['middleware' => ['permission:sismed::servidor.atestados'],'as' => 'sismed::servidor.atestados', 'uses' => 'ServidorController@atestados']);
   Route::get('servidor/consulta', ['middleware' => ['permission:sismed::servidor.consulta'],'as' => 'sismed::servidor.consulta', 'uses' => 'ServidorController@consulta']);
   Route::post('servidor/consultaws', ['middleware' => ['permission:sismed::servidor.consultaws'],'as' => 'sismed::servidor.consultaws', 'uses' => 'ServidorController@consultaws']);
   Route::get('servidor/exportar', ['middleware' => ['permission:sismed::servidor.exportar'],'as' => 'sismed::servidor.exportar', 'uses' => 'ServidorController@exportar']);


   //ATESTADO
   Route::get('atestados', ['middleware' => ['permission:sismed::atestados'],'as' => 'sismed::atestado.index', 'uses' => 'AtestadoController@index']);
   Route::get('atestado/consulta', ['middleware' => ['permission:sismed::atestados'],'as' => 'sismed::atestado.consulta', 'uses' => 'AtestadoController@consulta']);
   Route::get('atestado/show', ['middleware' => ['permission:sismed::atestado.show'],'as' => 'sismed::atestado.show', 'uses' => 'AtestadoController@show']);
   Route::get('atestado/new/{id}', ['middleware' => ['permission:sismed::atestado.create'],'as' => 'sismed::atestado.create', 'uses' => 'AtestadoController@create']);
   Route::post('atestado/store', ['middleware' => ['permission:sismed::atestado.store'],'as' => 'sismed::atestado.store', 'uses' => 'AtestadoController@store']);
   Route::get('atestado/edit/{id}', ['middleware' => ['permission:sismed::atestado.edit'],'as' => 'sismed::atestado.edit', 'uses' => 'AtestadoController@edit']);
   Route::put('atestado/update/{id}', ['middleware' => ['permission:sismed::atestado.update'],'as' => 'sismed::atestado.update', 'uses' => 'AtestadoController@update']);
   Route::post('atestado/destroy', ['middleware' => ['permission:sismed::atestado.destroy'],'as' => 'sismed::atestado.destroy', 'uses' => 'AtestadoController@destroy']);
   Route::post('atestado/upload', ['middleware' => ['permission:sismed::atestado.upload'],'as' => 'sismed::atestado.upload', 'uses' => 'AtestadoController@upload']);
   Route::get('atestado/cancelar/alertar/{id}', ['middleware' => ['permission:sismed::atestado.cancelar'],'as' => 'sismed::atestado.cancelar.alertar', 'uses' => 'AtestadoController@cancelarAlertar']);
   Route::get('atestado/cancelar/{id}', ['middleware' => ['permission:sismed::atestado.cancelar'],'as' => 'sismed::atestado.cancelar', 'uses' => 'AtestadoController@cancelar']);


   Route::get('atestado/emitir/{id}', ['middleware' => ['permission:sismed::atestados'],'as' => 'sismed::atestado.emitir', 'uses' => 'AtestadoController@emitirRecibo']);

   //PERICIA
   Route::get('atestado/pericia/edit/{id}', ['middleware' => ['permission:sismed::atestado.edit'],'as' => 'sismed::atestado.pericia.edit', 'uses' => 'PericiaController@edit']);
   Route::put('atestado/pericia/update/{id}', ['middleware' => ['permission:sismed::atestado.update'],'as' => 'sismed::atestado.pericia.update', 'uses' => 'PericiaController@update']);

   //RELATORIOS
   Route::get('relatorio/atestado', ['middleware' => ['permission:sismed::relatorio_atestados'],'as' => 'sismed::relatorio.index', 'uses' => 'RelatorioController@index']);
   Route::post('relatorio/atestado/atestados', ['middleware' => ['permission:sismed::relatorio_atestados'],'as' => 'sismed::relatorio.atestado', 'uses' => 'RelatorioController@atestados']);

   //MIGRACAO
   Route::get('migracao/importar', ['as' => 'sismed::importar', 'uses' =>'MigracaoController@importar']);
   Route::post('migracao/import',['as' => 'sismed::importExcel', 'uses' =>'MigracaoController@importExcel']);
   
});