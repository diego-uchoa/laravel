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

Route::group(['prefix' => 'gescon', 'middleware' => ['aviso','menu','auth']], function() {

    //INÍCIO
    Route::get('/', ['middleware' => ['permission:gescon::inicio'], 'as' => 'gescon::inicio', 'uses' => 'GesconController@index']);

    Route::get('modalidades',['middleware' => ['permission:gescon::modalidades.index'], 'as' => 'gescon::modalidades.index', 'uses' => 'ModalidadeController@index']);
    Route::get('modalidades/records', ['middleware' => ['permission:gescon::modalidades.index'], 'as' => 'gescon::modalidades.records', 'uses' => 'ModalidadeController@records']);
	Route::get('modalidades/new', ['middleware' => ['permission:gescon::modalidades.store'], 'as' => 'gescon::modalidades.create', 'uses' => 'ModalidadeController@create']);
	Route::post('modalidades/store', ['middleware' => ['permission:gescon::modalidades.store'], 'as' => 'gescon::modalidades.store', 'uses' => 'ModalidadeController@store']);
	Route::get('modalidades/edit/{id}', ['middleware' => ['permission:gescon::modalidades.edit'], 'as' => 'gescon::modalidades.edit', 'uses' => 'ModalidadeController@edit']);
	Route::put('modalidades/update/{id}', ['middleware' => ['permission:gescon::modalidades.edit'], 'as' => 'gescon::modalidades.update', 'uses' => 'ModalidadeController@update']);
	Route::get('modalidades/destroy/{id}', ['middleware' => ['permission:gescon::modalidades.destroy'], 'as' => 'gescon::modalidades.destroy', 'uses' => 'ModalidadeController@destroy']);
	Route::get('modalidades/list', ['as' => 'gescon::modalidades.list', 'uses' => 'ModalidadeController@listModalidades']);

	Route::get('contratadas', ['middleware' => ['permission:gescon::contratadas.index'], 'as' => 'gescon::contratadas.index', 'uses' => 'ContratadaController@index']);
	Route::get('contratadas/records', ['middleware' => ['permission:gescon::contratadas.index'], 'as' => 'gescon::contratadas.records', 'uses' => 'ContratadaController@records']);
	Route::get('contratadas/new', ['middleware' => ['permission:gescon::contratadas.store'], 'as' => 'gescon::contratadas.create', 'uses' => 'ContratadaController@create']);
	Route::post('contratadas/store', ['middleware' => ['permission:gescon::contratadas.store'], 'as' => 'gescon::contratadas.store', 'uses' => 'ContratadaController@store']);
	Route::get('contratadas/edit/{id}', ['middleware' => ['permission:gescon::contratadas.edit'], 'as' => 'gescon::contratadas.edit', 'uses' => 'ContratadaController@edit']);
	Route::put('contratadas/update/{id}', ['middleware' => ['permission:gescon::contratadas.edit'], 'as' => 'gescon::contratadas.update', 'uses' => 'ContratadaController@update']);
	Route::get('contratadas/destroy/{id}', ['middleware' => ['permission:gescon::contratadas.destroy'], 'as' => 'gescon::contratadas.destroy', 'uses' => 'ContratadaController@destroy']);
	
	Route::get('contratadas/recuperar-dados-ws/{cnpj}',['uses' => 'ContratadaController@findContratadaWsByCNPJ']);
	Route::get('contratadas/recuperar-dados-bd/{cnpj}',['uses' => 'ContratadaController@findContratadaByCNPJ']);
	
	Route::get('contratantes', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratantes.index', 'uses' => 'ContratanteController@index']);
	Route::get('contratantes/records', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratantes.records', 'uses' => 'ContratanteController@records']);

	Route::get('contratantes/new', ['middleware' => ['permission:gescon::contratantes.store'], 'as' => 'gescon::contratantes.create', 'uses' => 'ContratanteController@create']);
	Route::post('contratantes/store', ['middleware' => ['permission:gescon::contratantes.store'], 'as' => 'gescon::contratantes.store', 'uses' => 'ContratanteController@store']);
	Route::put('contratantes/update/{id}', ['middleware' => ['permission:gescon::contratantes.edit'], 'as' => 'gescon::contratantes.update', 'uses' => 'ContratanteController@update']);
	Route::get('contratantes/destroy/{id}', ['middleware' => ['permission:gescon::contratantes.destroy'], 'as' => 'gescon::contratantes.destroy', 'uses' => 'ContratanteController@destroy']);
	Route::get('contratantes/association_exist/{id}',['as' => 'gescon::contratantes.association_exist', 'uses' => 'ContratanteController@association_exist']);
	Route::get('contratantes/recuperar-dados/{co_uasg}',['uses' => 'ContratanteController@findDadosContratanteByUasg']);
	Route::get('contratantes/representante/associate-representante/{id}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratantes.representante.associate_representante', 'uses' => 'ContratanteController@associate_representante']);
	Route::get('contratantes/usuario/associate-usuario/{id}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratantes.usuario.associate_usuario', 'uses' => 'ContratanteController@associate_usuario']);
	Route::get('contratantes/assinante/associate-assinante/{id}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratantes.assinante.associate_assinante', 'uses' => 'ContratanteController@associate_assinante']);

	Route::get('contratante-representante/new/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_representante.create', 'uses' => 'ContratanteRepresentanteController@create']);
	Route::post('contratante-representante/store/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_representante.store', 'uses' => 'ContratanteRepresentanteController@store']);
	Route::get('contratante-representante/edit/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_representante.edit', 'uses' => 'ContratanteRepresentanteController@edit']);
	Route::put('contratante-representante/update/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_representante.update', 'uses' => 'ContratanteRepresentanteController@update']);
	Route::get('contratante-representante/modal_destroy_representante/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_representante.modal_destroy_representante', 'uses' => 'ContratanteRepresentanteController@modal_destroy_representante']);
	Route::post('contratante-representante/destroy_representante', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_representante.destroy_representante', 'uses' => 'ContratanteRepresentanteController@destroy_representante']);

	Route::get('contratante-usuario/new/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_usuario.create', 'uses' => 'ContratanteUsuarioController@create']);
	Route::post('contratante-usuario/store', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_usuario.store', 'uses' => 'ContratanteUsuarioController@store']);
	Route::get('contratante-usuario/destroy_usuario/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_usuario.destroy_usuario', 'uses' => 'ContratanteUsuarioController@destroy_usuario']);

	Route::get('contratante-assinante/new/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_assinante.create', 'uses' => 'ContratanteAssinanteController@create']);
	Route::post('contratante-assinante/store/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_assinante.store', 'uses' => 'ContratanteAssinanteController@store']);
	Route::get('contratante-assinante/edit/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_assinante.edit', 'uses' => 'ContratanteAssinanteController@edit']);
	Route::put('contratante-assinante/update/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_assinante.update', 'uses' => 'ContratanteAssinanteController@update']);
	Route::get('contratante-assinante/modal_destroy_assinante/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_assinante.modal_destroy_assinante', 'uses' => 'ContratanteAssinanteController@modal_destroy_assinante']);
	Route::get('contratante-assinante/destroy_assinante/{id}/{id_contratante}', ['middleware' => ['permission:gescon::contratantes.index'], 'as' => 'gescon::contratante_assinante.destroy_assinante', 'uses' => 'ContratanteAssinanteController@destroy_assinante']);
	Route::post('contratante-assinante/store_assinante_contrato',['as' => 'gescon::contratante_assinante.store_assinante_contrato', 'uses' => 'ContratanteAssinanteController@store_assinante_contrato']);
	Route::get('contratante-assinante/recupera-dados-bd/{id_contratante_assinante}',['uses' => 'ContratanteAssinanteController@findAssinanteById']);

	Route::get('fiscais', ['middleware' => ['permission:gescon::fiscais.index'], 'as' => 'gescon::fiscais.index', 'uses' => 'FiscalController@index']);
	Route::get('fiscais/records', ['middleware' => ['permission:gescon::fiscais.index'], 'as' => 'gescon::fiscais.records', 'uses' => 'FiscalController@records']);
	Route::get('fiscais/new', ['middleware' => ['permission:gescon::fiscais.store'], 'as' => 'gescon::fiscais.create', 'uses' => 'FiscalController@create']);
	Route::post('fiscais/store', ['middleware' => ['permission:gescon::fiscais.store'], 'as' => 'gescon::fiscais.store', 'uses' => 'FiscalController@store']);
	Route::get('fiscais/edit/{id}', ['middleware' => ['permission:gescon::fiscais.edit'], 'as' => 'gescon::fiscais.edit', 'uses' => 'FiscalController@edit']);
	Route::put('fiscais/update/{id}', ['middleware' => ['permission:gescon::fiscais.edit'], 'as' => 'gescon::fiscais.update', 'uses' => 'FiscalController@update']);
	Route::get('fiscais/destroy/{id}', ['middleware' => ['permission:gescon::fiscais.destroy'], 'as' => 'gescon::fiscais.destroy', 'uses' => 'FiscalController@destroy']);
	Route::get('fiscais/recuperar-dados-bd/{cpf}',['uses' => 'FiscalController@findDadosFiscalByCPF']);

	Route::get('edificios/recuperar-dados-bd/{sg_uf}',['uses' => 'EdificioController@listEdificiosByUf']);
	
	Route::get('contratos', ['middleware' => ['permission:gescon::contratos.index'], 'as' => 'gescon::contratos.index', 'uses' => 'ContratoController@index']);
	Route::get('contratos/records', ['middleware' => ['permission:gescon::contratos.index'], 'as' => 'gescon::contratos.records', 'uses' => 'ContratoController@records']);
	Route::get('contratos/destroy/{id}', ['middleware' => ['permission:gescon::contratos.destroy'], 'as' => 'gescon::contratos.destroy', 'uses' => 'ContratoController@destroy']);
	Route::get('contratos/reativar/{nu_contrato}/{co_uasg}', ['middleware' => ['permission:gescon::contratos.store'], 'uses' => 'ContratoController@reativarContratoExcluidoByNuContratoCoUasg']);
	Route::get('contratos/recuperar-dados-ws/{nu_contrato}/{co_uasg}',['uses' => 'ContratoController@findContratoWsByNuContratoCoUasg']);
	Route::get('contratos/recuperar-dados-bd/{nu_contrato}/{co_uasg}',['uses' => 'ContratoController@findContratoBdByNuContratoCoUasg']);
	Route::get('contratos/exists/{nu_contrato}/{co_uasg}',['uses' => 'ContratoController@existsContratoByNuContratoCoUasg']);
	Route::get('contratos/deleted/{nu_contrato}/{co_uasg}',['uses' => 'ContratoController@existsContratoExcluidoByNuContratoCoUasg']);
	Route::get('contratos/preposto/destroy/{id_contrato_preposto}', ['middleware' => ['permission:gescon::contratos.store'], 'uses' => 'ContratoController@disassociate_preposto']);
	Route::get('contratos/processo-pagamento/destroy/{id_contrato_processo_pagamento}', ['middleware' => ['permission:gescon::contratos.store'], 'uses' => 'ContratoController@disassociate_processo_pagamento']);
	Route::get('contratos/fiscal/destroy/{id_contrato_fiscal}', ['middleware' => ['permission:gescon::contratos.store'], 'uses' => 'ContratoController@disassociate_fiscal']);
	Route::get('contratos/informacao-adicional/destroy/{id_contrato_informacao_adicional}', ['middleware' => ['permission:gescon::contratos.store'], 'uses' => 'ContratoController@disassociate_informacao_adicional']);
	Route::post('contratos/arquivo-ebps/upload-tmp', ['as' => 'gescon::contratos.arquivo_ebps.upload_tmp', 'uses' => 'ContratoController@gravarArquivoEbpsTemporario']);
	Route::get('contratos/modal_encerramento/{id_contrato}', ['middleware' => ['permission:gescon::contratos.index'], 'as' => 'gescon::contratos.modal_encerramento', 'uses' => 'ContratoController@modal_encerramento']);
	Route::post('contratos/encerramento', ['middleware' => ['permission:gescon::contratos.index'], 'as' => 'gescon::contratos.encerramento', 'uses' => 'ContratoController@encerrar']);

	Route::get('contratos/terceirizacao/new/{inObjeto}', ['middleware' => ['permission:gescon::contratos.store'], 'as' => 'gescon::contratos.terceirizacao.create', 'uses' => 'ContratoTerceirizacaoController@create']);
	Route::post('contratos/terceirizacao/store', ['middleware' => ['permission:gescon::contratos.store'], 'as' => 'gescon::contratos.terceirizacao.store', 'uses' => 'ContratoTerceirizacaoController@store']);
	Route::get('contratos/terceirizacao/show/{id}',['as' => 'gescon::contratos.terceirizacao.show', 'uses' => 'ContratoTerceirizacaoController@show']);
	Route::get('contratos/terceirizacao/edit/{id}', ['middleware' => ['permission:gescon::contratos.edit'], 'as' => 'gescon::contratos.terceirizacao.edit', 'uses' => 'ContratoTerceirizacaoController@edit']);
	Route::put('contratos/terceirizacao/update/{id}', ['middleware' => ['permission:gescon::contratos.edit'], 'as' => 'gescon::contratos.terceirizacao.update', 'uses' => 'ContratoTerceirizacaoController@update']);
	Route::get('contratos/terceirizacao/item-contratacao/destroy/{id_contrato_item_contratacao}', ['middleware' => ['permission:gescon::contratos.store'], 'uses' => 'ContratoTerceirizacaoController@destroy_item_contratacao']);

	Route::get('tipos-itens-contratacao', ['middleware' => ['permission:gescon::tipos_itens_contratacao.index'], 'as' => 'gescon::tipos_itens_contratacao.index', 'uses' => 'TipoItemContratacaoController@index']);
	Route::get('tipos-itens-contratacao/records', ['middleware' => ['permission:gescon::tipos_itens_contratacao.index'], 'as' => 'gescon::tipos_itens_contratacao.records', 'uses' => 'TipoItemContratacaoController@records']);
	Route::get('tipos-itens-contratacao/new', ['middleware' => ['permission:gescon::tipos_itens_contratacao.store'], 'as' => 'gescon::tipos_itens_contratacao.create', 'uses' => 'TipoItemContratacaoController@create']);
	Route::post('tipos-itens-contratacao/store', ['middleware' => ['permission:gescon::tipos_itens_contratacao.store'], 'as' => 'gescon::tipos_itens_contratacao.store', 'uses' => 'TipoItemContratacaoController@store']);
	Route::get('tipos-itens-contratacao/edit/{id}', ['middleware' => ['permission:gescon::tipos_itens_contratacao.edit'], 'as' => 'gescon::tipos_itens_contratacao.edit', 'uses' => 'TipoItemContratacaoController@edit']);
	Route::put('tipos-itens-contratacao/update/{id}', ['middleware' => ['permission:gescon::tipos_itens_contratacao.edit'], 'as' => 'gescon::tipos_itens_contratacao.update', 'uses' => 'TipoItemContratacaoController@update']);
	Route::get('tipos-itens-contratacao/destroy/{id}', ['middleware' => ['permission:gescon::tipos_itens_contratacao.destroy'], 'as' => 'gescon::tipos_itens_contratacao.destroy', 'uses' => 'TipoItemContratacaoController@destroy']);
	Route::get('tipos-itens-contratacao/list-por-objeto/{objeto}',['as' => 'gescon::tipos_itens_contratacao.list_por_objeto', 'uses' => 'TipoItemContratacaoController@listTipoItemContratacaoByNomeObjeto']);
	
	Route::get('unidades-medida-item-contratacao', ['middleware' => ['permission:gescon::unidades_medida_item_contratacao.index'], 'as' => 'gescon::unidades_medida_item_contratacao.index', 'uses' => 'UnidadeMedidaItemContratacaoController@index']);
	Route::get('unidades-medida-item-contratacao/records', ['middleware' => ['permission:gescon::tipos_itens_contratacao.index'], 'as' => 'gescon::unidades_medida_item_contratacao.records', 'uses' => 'UnidadeMedidaItemContratacaoController@records']);
	Route::get('unidades-medida-item-contratacao/new', ['middleware' => ['permission:gescon::tipos_itens_contratacao.store'], 'as' => 'gescon::unidades_medida_item_contratacao.create', 'uses' => 'UnidadeMedidaItemContratacaoController@create']);
	Route::post('unidades-medida-item-contratacao/store', ['middleware' => ['permission:gescon::tipos_itens_contratacao.store'], 'as' => 'gescon::unidades_medida_item_contratacao.store', 'uses' => 'UnidadeMedidaItemContratacaoController@store']);
	Route::get('unidades-medida-item-contratacao/edit/{id}', ['middleware' => ['permission:gescon::tipos_itens_contratacao.edit'], 'as' => 'gescon::unidades_medida_item_contratacao.edit', 'uses' => 'UnidadeMedidaItemContratacaoController@edit']);
	Route::put('unidades-medida-item-contratacao/update/{id}', ['middleware' => ['permission:gescon::tipos_itens_contratacao.edit'], 'as' => 'gescon::unidades_medida_item_contratacao.update', 'uses' => 'UnidadeMedidaItemContratacaoController@update']);
	Route::get('unidades-medida-item-contratacao/destroy/{id}', ['middleware' => ['permission:gescon::tipos_itens_contratacao.destroy'], 'as' => 'gescon::unidades_medida_item_contratacao.destroy', 'uses' => 'UnidadeMedidaItemContratacaoController@destroy']);	

	//Calendário Contrato
	Route::get('contratos/calendario/{id?}', ['as' => 'gescon::contratos.calendario', 'uses' => 'ContratoController@findDadosContratoCalendarioById']);

	//Relatórios
	Route::get('relatorios/geral-contrato', ['as' => 'gescon::relatorios.geral_contrato', 'uses' => 'RelatorioContratoController@index_geral_contrato']);
	Route::get('relatorios/comparativo-contrato', ['as' => 'gescon::relatorios.comparativo_contrato', 'uses' => 'RelatorioContratoController@index_comparativo_contrato']);
	Route::post('relatorios/processa-comparativo', ['as' => 'gescon::relatorios.processa_comparativo', 'uses' => 'RelatorioContratoComparativoController@processa_relatorio']);
	Route::post('relatorios/processa-geral', ['as' => 'gescon::relatorios.processa_geral', 'uses' => 'RelatorioContratoGeralController@processa_relatorio']);
	
});
