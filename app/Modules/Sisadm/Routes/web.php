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

Route::group(['prefix' => 'sisadm', 'middleware' => ['aviso','menu','auth']], function() {

	Route::get('/',['middleware' => ['permission:sisadm::inicio'], 'as' => 'sisadm::inicio', 'uses' => 'SisadmController@index']);

    //ITENS DE MENU
    Route::get('itens-menu',[ 'middleware' => ['permission:sisadm::itens_menu.index'],'as' => 'sisadm::itens_menu.index', 'uses' => 'ItensMenuController@index']);
    Route::get('itens-menu/new',[ 'middleware' => ['permission:sisadm::itens_menu.create'],'as' => 'sisadm::itens_menu.create', 'uses' => 'ItensMenuController@create']);
    Route::post('itens-menu/store',[ 'middleware' => ['permission:sisadm::itens_menu.store'],'as' => 'sisadm::itens_menu.store', 'uses' => 'ItensMenuController@store']);
    Route::get('itens-menu/edit/{id}',[ 'middleware' => ['permission:sisadm::itens_menu.edit'],'as' => 'sisadm::itens_menu.edit', 'uses' => 'ItensMenuController@edit']);
    Route::put('itens-menu/update/{id}',[ 'middleware' => ['permission:sisadm::itens_menu.update'],'as' => 'sisadm::itens_menu.update', 'uses' => 'ItensMenuController@update']);
    Route::get('itens-menu/destroy/{id}',[ 'middleware' => ['permission:sisadm::itens_menu.destroy'],'as' => 'sisadm::itens_menu.destroy', 'uses' => 'ItensMenuController@destroy']);
		
	//USUARIOS
	Route::get('usuarios', [ 'middleware' => ['permission:sisadm::usuarios.index'],'as' => 'sisadm::usuarios.index', 'uses' => 'UsuariosController@index']);
    Route::get('usuarios/records', [ 'middleware' => ['permission:sisadm::usuarios.index'],'as' => 'sisadm::usuarios.records', 'uses' => 'UsuariosController@records']);
    Route::get('usuarios/new', [ 'middleware' => ['permission:sisadm::usuarios.create'],'as' => 'sisadm::usuarios.create', 'uses' => 'UsuariosController@create']);
	Route::post('usuarios/store', [ 'middleware' => ['permission:sisadm::usuarios.store'],'as' => 'sisadm::usuarios.store', 'uses' => 'UsuariosController@store']);
	Route::get('usuarios/edit/{id}', [ 'middleware' => ['permission:sisadm::usuarios.edit'],'as' => 'sisadm::usuarios.edit', 'uses' => 'UsuariosController@edit']);
	Route::put('usuarios/update/{id}', [ 'middleware' => ['permission:sisadm::usuarios.update'],'as' => 'sisadm::usuarios.update', 'uses' => 'UsuariosController@update']);
	Route::get('usuarios/destroy/{id}', [ 'middleware' => ['permission:sisadm::usuarios.destroy'],'as' => 'sisadm::usuarios.destroy', 'uses' => 'UsuariosController@destroy']);
	Route::get('usuarios/perfis/{id}', [ 'middleware' => ['permission:sisadm::usuarios.perfis'],'as' => 'sisadm::usuarios.perfis', 'uses' => 'UsuariosController@perfis']);
	Route::post('usuarios/perfis/{id}/store', [ 'middleware' => ['permission:sisadm::usuarios.perfis.store'],'as' => 'sisadm::usuarios.perfis.store', 'uses' => 'UsuariosController@storePerfil']);
	Route::get('usuarios/perfis/{id}/revoke/{role_id}', [ 'middleware' => ['permission:sisadm::usuarios.perfis.revoke'],'as' => 'sisadm::usuarios.perfis.revoke', 'uses' => 'UsuariosController@revokePerfil']);
    Route::get('usuarios/verifica-perfil/{nr_cpf}/{no_sistema}',['uses' => 'UsuariosController@findUsuarioBySistema']);

	//PERFIS
	Route::get('perfis',[ 'middleware' => ['permission:sisadm::perfis.index'],'as' => 'sisadm::perfis.index', 'uses' => 'PerfisController@index']);
    Route::get('perfis/new', [ 'middleware' => ['permission:sisadm::perfis.create'],'as' => 'sisadm::perfis.create', 'uses' => 'PerfisController@create']);
    Route::post('perfis/store', [ 'middleware' => ['permission:sisadm::perfis.store'],'as' => 'sisadm::perfis.store', 'uses' => 'PerfisController@store']);
    Route::get('perfis/edit/{id}', [ 'middleware' => ['permission:sisadm::perfis.edit'],'as' => 'sisadm::perfis.edit', 'uses' => 'PerfisController@edit']);
    Route::put('perfis/update/{id}', [ 'middleware' => ['permission:sisadm::perfis.update'],'as' => 'sisadm::perfis.update', 'uses' => 'PerfisController@update']);
    Route::get('perfis/destroy/{id}', [ 'middleware' => ['permission:sisadm::perfis.destroy'],'as' => 'sisadm::perfis.destroy', 'uses' => 'PerfisController@destroy']);
    Route::get('perfis/operacoes/{id}', [ 'middleware' => ['permission:sisadm::perfis.operacoes'],'as' => 'sisadm::perfis.operacoes', 'uses' => 'PerfisController@operacoes']);
    Route::post('perfis/operacoes/{id}/store', [ 'middleware' => ['permission:sisadm::perfis.operacoes.store'],'as' => 'sisadm::perfis.operacoes.store', 'uses' => 'PerfisController@storeoperacoes']);
    Route::get('perfis/operacoes/{id}/revoke/{permission_id}', [ 'middleware' => ['permission:sisadm::perfis.operacoes.revoke'],'as' => 'sisadm::perfis.operacoes.revoke', 'uses' => 'PerfisController@revokeoperacoes']);
    Route::get('perfis/itens/{id}', [ 'middleware' => ['permission:sisadm::perfis.itens'],'as'=>'sisadm::perfis.itens', 'uses'=>'PerfisController@getItensMenu']);

    //OPERAÇÕES
    Route::get('operacoes', [ 'middleware' => ['permission:sisadm::operacoes.index'],'as' => 'sisadm::operacoes.index', 'uses' => 'OperacoesController@index']);
    Route::get('operacoes/new', [ 'middleware' => ['permission:sisadm::operacoes.create'],'as' => 'sisadm::operacoes.create', 'uses' => 'OperacoesController@create']);
    Route::post('operacoes/store', [ 'middleware' => ['permission:sisadm::operacoes.store'],'as' => 'sisadm::operacoes.store', 'uses' => 'OperacoesController@store']);
    Route::get('operacoes/edit/{id}', [ 'middleware' => ['permission:sisadm::operacoes.edit'],'as' => 'sisadm::operacoes.edit', 'uses' => 'OperacoesController@edit']);
    Route::put('operacoes/update/{id}', [ 'middleware' => ['permission:sisadm::operacoes.update'],'as' => 'sisadm::operacoes.update', 'uses' => 'OperacoesController@update']);
    Route::get('operacoes/destroy/{id}', [ 'middleware' => ['permission:sisadm::operacoes.destroy'],'as' => 'sisadm::operacoes.destroy', 'uses' => 'OperacoesController@destroy']);

    //SISTEMAS
    Route::get('sistemas',[ 'middleware' => ['permission:sisadm::sistemas.index'],'as' => 'sisadm::sistemas.index', 'uses' => 'SistemasController@index']);
    Route::get('sistemas/new',[ 'middleware' => ['permission:sisadm::sistemas.create'],'as' => 'sisadm::sistemas.create', 'uses' => 'SistemasController@create']);
    Route::post('sistemas/store',[ 'middleware' => ['permission:sisadm::sistemas.store'],'as' => 'sisadm::sistemas.store', 'uses' => 'SistemasController@store']);
    Route::get('sistemas/edit/{id}',[ 'middleware' => ['permission:sisadm::sistemas.edit'],'as' => 'sisadm::sistemas.edit', 'uses' => 'SistemasController@edit']);
    Route::put('sistemas/update/{id}',[ 'middleware' => ['permission:sisadm::sistemas.update'],'as' => 'sisadm::sistemas.update', 'uses' => 'SistemasController@update']);
    Route::get('sistemas/destroy/{id}',[ 'middleware' => ['permission:sisadm::sistemas.destroy'],'as' => 'sisadm::sistemas.destroy', 'uses' => 'SistemasController@destroy']);
    Route::get('sistemas/orgaos/{id}',[ 'middleware' => ['permission:sisadm::sistemas.edit'],'as' => 'sisadm::sistemas.orgaos', 'uses' => 'SistemasController@orgaos']);
    Route::get('sistemas/orgaos/new/{id}',[ 'middleware' => ['permission:sisadm::sistemas.edit'],'as' => 'sisadm::sistemas.orgaos.create', 'uses' => 'SistemasController@createOrgao']);
    Route::post('sistemas/orgaos/store',[ 'middleware' => ['permission:sisadm::sistemas.edit'],'as' => 'sisadm::sistemas.orgaos.store', 'uses' => 'SistemasController@storeOrgao']);
    Route::get('sistemas/orgaos/destroy/{id_sistema}/{id_orgao}',[ 'middleware' => ['permission:sisadm::sistemas.edit'],'as' => 'sisadm::sistemas.orgaos.destroy', 'uses' => 'SistemasController@destroyOrgao']);

    //ORGAOS
    Route::get('orgaos',['as' => 'sisadm::orgaos.index', 'uses' => 'OrgaoController@index']);
    Route::get('orgaos/new',['as' => 'sisadm::orgaos.create', 'uses' => 'OrgaoController@create']);
    Route::post('orgaos/store',['as' => 'sisadm::orgaos.store', 'uses' => 'OrgaoController@store']);
    Route::get('orgaos/edit/{id}',['as' => 'sisadm::orgaos.edit', 'uses' => 'OrgaoController@edit']);
    Route::put('orgaos/update/{id}',['as' => 'sisadm::orgaos.update', 'uses' => 'OrgaoController@update']);
    Route::get('orgaos/destroy/{id}',['as' => 'sisadm::orgaos.destroy', 'uses' => 'OrgaoController@destroy']);
    Route::get('orgao/list',['as' => 'orgao.list', 'uses' => 'OrgaoController@listOrgaosByNomeSigla']);
    Route::get('orgao/list-por-sistema/{no_sistema}',['as' => 'orgao.list_por_sistema', 'uses' => 'OrgaoController@listOrgaosByNomeSiglaSistema']);
    Route::get('orgaos/importacaoWS',['as' => 'sisadm::orgaos.importacaoWS', 'uses' => 'OrgaoController@findOrgaoByCodigoUorgWS']);
    Route::get('orgaos/siafi/{co_siafi}',['as' => 'sisadm::orgaos.siafi', 'uses' => 'OrgaoController@findOrgaoByCodigoSiafi']);

    //AVISO SISTEMA
    Route::get('aviso-sistema', [ 'middleware' => ['permission:sisadm::aviso_sistema.index'],'as' => 'sisadm::aviso_sistema.index', 'uses' => 'AvisoSistemaController@index']);
    Route::get('aviso-sistema/new', [ 'middleware' => ['permission:sisadm::aviso_sistema.create'],'as' => 'sisadm::aviso_sistema.create', 'uses' => 'AvisoSistemaController@create']);
    Route::post('aviso-sistema/store', [ 'middleware' => ['permission:sisadm::aviso_sistema.store'],'as' => 'sisadm::aviso_sistema.store', 'uses' => 'AvisoSistemaController@store']);
    Route::get('aviso-sistema/edit/{id}', [ 'middleware' => ['permission:sisadm::aviso_sistema.edit'],'as' => 'sisadm::aviso_sistema.edit', 'uses' => 'AvisoSistemaController@edit']);
    Route::put('aviso-sistema/update/{id}', [ 'middleware' => ['permission:sisadm::aviso_sistema.update'],'as' => 'sisadm::aviso_sistema.update', 'uses' => 'AvisoSistemaController@update']);
    Route::get('aviso-sistema/destroy/{id}', [ 'middleware' => ['permission:sisadm::aviso_sistema.destroy'],'as' => 'sisadm::aviso_sistema.destroy', 'uses' => 'AvisoSistemaController@destroy']);

    //AVISO USUARIO
    Route::get('aviso-usuario', [ 'middleware' => ['permission:sisadm::aviso_usuario.index'],'as' => 'sisadm::aviso_usuario.index', 'uses' => 'AvisoUsuarioController@index']);
    Route::get('aviso-usuario/new', [ 'middleware' => ['permission:sisadm::aviso_usuario.create'],'as' => 'sisadm::aviso_usuario.create', 'uses' => 'AvisoUsuarioController@create']);
    Route::post('aviso-usuario/store', [ 'middleware' => ['permission:sisadm::aviso_usuario.store'],'as' => 'sisadm::aviso_usuario.store', 'uses' => 'AvisoUsuarioController@store']);
    Route::get('aviso-usuario/edit/{id}', [ 'middleware' => ['permission:sisadm::aviso_usuario.edit'],'as' => 'sisadm::aviso_usuario.edit', 'uses' => 'AvisoUsuarioController@edit']);
    Route::put('aviso-usuario/update/{id}', [ 'middleware' => ['permission:sisadm::aviso_usuario.update'],'as' => 'sisadm::aviso_usuario.update', 'uses' => 'AvisoUsuarioController@update']);
    Route::get('aviso-usuario/destroy/{id}', [ 'middleware' => ['permission:sisadm::aviso_usuario.destroy'],'as' => 'sisadm::aviso_usuario.destroy', 'uses' => 'AvisoUsuarioController@destroy']);

    //AVISO GERAL
    Route::get('aviso-geral/{sistema}', [ 'middleware' => ['permission:sisadm::aviso_geral.index'],'as' => 'sisadm::aviso_geral.index', 'uses' => 'AvisoGeralController@index']);
    Route::get('aviso-geral-todos', [ 'middleware' => ['permission:sisadm::aviso_geral.indexGeral'], 'as' => 'sisadm::aviso_geral.indexGeral', 'uses' => 'AvisoGeralController@indexGeral']);


    //FERIADO
    Route::get('feriado', [ 'middleware' => ['permission:sisadm::feriado.index'],'as' => 'sisadm::feriado.index', 'uses' => 'FeriadoController@index']);
    Route::get('feriado/new', [ 'middleware' => ['permission:sisadm::feriado.create'],'as' => 'sisadm::feriado.create', 'uses' => 'FeriadoController@create']);
    Route::post('feriado/store', [ 'middleware' => ['permission:sisadm::feriado.store'],'as' => 'sisadm::feriado.store', 'uses' => 'FeriadoController@store']);
    Route::get('feriado/edit/{id}', [ 'middleware' => ['permission:sisadm::feriado.edit'],'as' => 'sisadm::feriado.edit', 'uses' => 'FeriadoController@edit']);
    Route::put('feriado/update/{id}', [ 'middleware' => ['permission:sisadm::feriado.update'],'as' => 'sisadm::feriado.update', 'uses' => 'FeriadoController@update']);
    Route::get('feriado/destroy/{id}', [ 'middleware' => ['permission:sisadm::feriado.destroy'],'as' => 'sisadm::feriado.destroy', 'uses' => 'FeriadoController@destroy']);


    //OPERACAO FAVORITA    
    Route::get('operacao-favorita', [ 'middleware' => ['permission:sisadm::operacao_favorita.index'],'as' => 'sisadm::operacao_favorita.index', 'uses' => 'OperacaoFavoritaController@index']);
    Route::post('operacao-favorita/store', [ 'middleware' => ['permission:sisadm::operacao_favorita.store'],'as' => 'sisadm::operacao_favorita.store', 'uses' => 'OperacaoFavoritaController@store']);
   

    //EVENTO
    Route::get('evento', [ 'middleware' => ['permission:sisadm::evento.index'],'as' => 'sisadm::evento.index', 'uses' => 'EventoController@index']);
    Route::get('evento/new', [ 'middleware' => ['permission:sisadm::evento.create'],'as' => 'sisadm::evento.create', 'uses' => 'EventoController@create']);
    Route::post('evento/store', [ 'middleware' => ['permission:sisadm::evento.store'],'as' => 'sisadm::evento.store', 'uses' => 'EventoController@store']);
    Route::get('evento/edit/{id}', [ 'middleware' => ['permission:sisadm::evento.edit'],'as' => 'sisadm::evento.edit', 'uses' => 'EventoController@edit']);
    Route::put('evento/update/{id}', [ 'middleware' => ['permission:sisadm::evento.update'],'as' => 'sisadm::evento.update', 'uses' => 'EventoController@update']);
    Route::get('evento/destroy/{id}', [ 'middleware' => ['permission:sisadm::evento.destroy'],'as' => 'sisadm::evento.destroy', 'uses' => 'EventoController@destroy']);


    //INCOSISTENCIA
    Route::get('inconsistencia', [ 'middleware' => ['permission:sisadm::inconsistencia.index'],'as' => 'sisadm::inconsistencia.index', 'uses' => 'InconsistenciaController@index']);
    Route::get('inconsistencia/verifica', [ 'middleware' => ['permission:sisadm::inconsistencia.verifica'],'as' => 'sisadm::inconsistencia.verifica', 'uses' => 'InconsistenciaController@verifica']);
    Route::get('inconsistencia/limpa', [ 'middleware' => ['permission:sisadm::inconsistencia.limpa'],'as' => 'sisadm::inconsistencia.limpa', 'uses' => 'InconsistenciaController@limpa']);
    Route::get('inconsistencia/destroy/{id}', [ 'middleware' => ['permission:sisadm::inconsistencia.destroy'],'as' => 'sisadm::inconsistencia.destroy', 'uses' => 'InconsistenciaController@destroy']);

   

    //AUDITORIA
    Route::get('auditoria', [ 'middleware' => ['permission:sisadm::auditoria.search'],'as' => 'sisadm::auditoria.search', 'uses' => 'AuditoriaController@search']);
    
    //Visualizador de Logs
    //Route::get('log', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    //Route::get('log', ['as' => 'sisadm::log', 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);
});