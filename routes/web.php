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

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', function () { return redirect('portal'); });

Route::auth();

Route::group(['prefix' => 'portal', 'as' => 'portal.', 'middleware' => ['web','auth']], function () 
{

	//Início
	Route::get('/', 'HomeController@index');
    Route::get('inicio',['as' => 'inicio', 'uses' => 'HomeController@index']);

	//Profile
    Route::get('profile',['as' => 'profile.index', 'uses' => 'ProfileController@index']);
    Route::get('profile/dados/{cpf}',['as' => 'profile.dados', 'uses' => 'ProfileController@findDadosServidorWsByCPF']);
    Route::post('profile/photo',['as' => 'profile.photo', 'uses' => 'ProfileController@updatePhoto']);
    
    //Calendário
    Route::get('home/calendario/{page}/{id?}', ['as' => 'home.calendario', 'uses' => 'HomeController@findDadosCalendarioById']);

    //Municipios
    Route::get('municipios/lista/{uf}', ['as' => 'municipios.lista', 'uses' => 'MunicipioController@listMunicipiosByUf']);
    
});