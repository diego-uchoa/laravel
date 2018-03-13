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

Route::group(['prefix' => 'parla', 'middleware' => ['aviso', 'menu', 'auth']], function () {
    Route::get('/', ['middleware' => ['permission:parla::inicio'],'as' => 'parla::inicio', 'uses' => 'ParlaController@index']);

    //PROPOSICOES
    Route::get('proposicoes',['middleware' => ['permission:parla::proposicoes.index'],'as' => 'parla::proposicoes.index', 'uses' => 'ProposicaoController@index']);
    Route::get('proposicoes/listar',['middleware' => ['permission:parla::proposicoes.index'],'as' => 'parla::proposicoes.list', 'uses' => 'ProposicaoController@list']);
    Route::get('proposicoes/detalhes/{id}',['middleware' => ['permission:parla::proposicoes.show'],'as' => 'parla::proposicoes.show', 'uses' => 'ProposicaoController@show']);
    Route::get('proposicoes/detalhes/prioritario/{id}',['middleware' => ['permission:parla::proposicoes.show'],'as' => 'parla::proposicoes.show.prioritario', 'uses' => 'ProposicaoController@getPrioritario']);
    Route::get('proposicoes/adicionar',['middleware' => ['permission:parla::proposicoes.create'],'as' => 'parla::proposicoes.create', 'uses' => 'ProposicaoController@create']);
    Route::post('proposicoes/cadastrar',['middleware' => ['permission:parla::proposicoes.store'],'as' => 'parla::proposicoes.store', 'uses' => 'ProposicaoController@store']);
    Route::get('proposicoes/editar/observacao/{id}',['middleware' => ['permission:parla::proposicoes.edit.observacao'],'as' => 'parla::proposicoes.edit.observacao', 'uses' => 'ProposicaoController@editObservacao']);
    Route::put('proposicoes/atualizar/observacao/{id}',['middleware' => ['permission:parla::proposicoes.update.observacao'],'as' => 'parla::proposicoes.update.observacao', 'uses' => 'ProposicaoController@updateObservacao']);
    Route::get('proposicoes/editar/prioritario/{id}',['middleware' => ['permission:parla::proposicoes.edit.prioritario'],'as' => 'parla::proposicoes.edit.prioritario', 'uses' => 'ProposicaoController@editPrioritario']);
    Route::put('proposicoes/atualizar/prioritario/{id}',['middleware' => ['permission:parla::proposicoes.update.prioritario'],'as' => 'parla::proposicoes.update.prioritario', 'uses' => 'ProposicaoController@updatePrioritario']); 
    Route::get('proposicoes/excluir/{id}',['middleware' => ['permission:parla::proposicoes.destroy'],'as' => 'parla::proposicoes.destroy', 'uses' => 'ProposicaoController@destroy']);

    //PARLAMENTARES
    Route::get('parlamentares',['middleware' => ['permission:parla::parlamentares.index'],'as' => 'parla::parlamentares.index', 'uses' => 'ParlamentarController@index']);
    Route::get('parlamentares/listar',['middleware' => ['permission:parla::parlamentares.index'],'as' => 'parla::parlamentares.list', 'uses' => 'ParlamentarController@list']);
    Route::get('parlamentares/perfil/{id}',['middleware' => ['permission:parla::parlamentares.show'],'as' => 'parla::parlamentares.show', 'uses' => 'ParlamentarController@show']);
    Route::get('parlamentares/editar/posicionamento/{id}',['middleware' => ['permission:parla::parlamentares.edit'],'as' => 'parla::parlamentares.edit.posicionamento', 'uses' => 'ParlamentarController@editPosicionamento']);
    Route::put('parlamentares/atualizar/posicionamento/{id}',['middleware' => ['permission:parla::parlamentares.update'],'as' => 'parla::parlamentares.update.posicionamento', 'uses' => 'ParlamentarController@updatePosicionamento']); 

    //CONSULTAS AO MF
    Route::get('consultas',['middleware' => ['permission:parla::consultasMf.index'],'as' => 'parla::consultasMf.index', 'uses' => 'ConsultaMfController@index']);
    Route::get('consultas/listar',['middleware' => ['permission:parla::consultasMf.index'],'as' => 'parla::consultasMf.list', 'uses' => 'ConsultaMfController@list']);
    Route::get('consultas/adicionar/{id_proposicao?}',['middleware' => ['permission:parla::consultasMf.create'],'as' => 'parla::consultasMf.create', 'uses' => 'ConsultaMfController@create']);
    Route::post('consultas/cadastrar/{id_proposicao?}',['middleware' => ['permission:parla::consultasMf.store'],'as' => 'parla::consultasMf.store', 'uses' => 'ConsultaMfController@store']);
    Route::get('consultas/editar/{id}/{id_proposicao?}',['middleware' => ['permission:parla::consultasMf.edit'],'as' => 'parla::consultasMf.edit', 'uses' => 'ConsultaMfController@edit']);
    Route::put('consultas/atualizar/{id}/{id_proposicao?}',['middleware' => ['permission:parla::consultasMf.update'],'as' => 'parla::consultasMf.update', 'uses' => 'ConsultaMfController@update']);
    Route::get('consultas/excluir/{id}/{id_proposicao?}',['middleware' => ['permission:parla::consultasMf.destroy'],'as' => 'parla::consultasMf.destroy', 'uses' => 'ConsultaMfController@destroy']);
    Route::get('consultas/relatorio',['middleware' => ['permission:parla::consultasMf.relatorio'],'as' => 'parla::consultasMf.relatorio', 'uses' => 'ConsultaMfController@relatorio']);
    Route::post('consultas/relatorio/gerar',['middleware' => ['permission:parla::consultasMf.relatorio.generate'],'as' => 'parla::consultasMf.relatorio.generate', 'uses' => 'ConsultaMfController@geraRelatorio']);

    //RESPOSTAS DO MF
    Route::get('respostas',['middleware' => ['permission:parla::respostas_mf.index'],'as' => 'parla::respostas_mf.index', 'uses' => 'RespostaMfController@index']);
    Route::get('respostas/listar',['middleware' => ['permission:parla::respostas_mf.index'],'as' => 'parla::respostas_mf.list', 'uses' => 'RespostaMfController@list']);
    Route::get('respostas/adicionar/{id_proposicao?}',['middleware' => ['permission:parla::respostas_mf.create'],'as' => 'parla::respostas_mf.create', 'uses' => 'RespostaMfController@create']);
    Route::post('respostas/cadastrar/{id_proposicao?}',['as' => 'parla::respostas_mf.store', 'uses' => 'RespostaMfController@store']);
    Route::get('respostas/editar/{id}/{id_proposicao?}',['middleware' => ['permission:parla::respostas_mf.edit'],'as' => 'parla::respostas_mf.edit', 'uses' => 'RespostaMfController@edit']);
    Route::put('respostas/atualizar/{id}/{id_proposicao?}',['as' => 'parla::respostas_mf.update', 'uses' => 'RespostaMfController@update']);
    Route::get('respostas/excluir/{id}/{id_proposicao?}',['middleware' => ['permission:parla::respostas_mf.destroy'],'as' => 'parla::respostas_mf.destroy', 'uses' => 'RespostaMfController@destroy']);

    //COMISSOES
    Route::get('comissoes',['middleware' => ['permission:parla::comissoes.index'],'as' => 'parla::comissoes.index', 'uses' => 'ComissaoController@index']);
    Route::get('comissoes/composicao/{id}',['middleware' => ['permission:parla::comissoes.show'],'as' => 'parla::comissoes.show', 'uses' => 'ComissaoController@show']);
    Route::get('comissoes/editar/posicionamento/{id_comissao}/{id_parlamentar}/{origin}',['middleware' => ['permission:parla::comissoes.show.edit'],'as' => 'parla::comissoes.edit.posicionamento', 'uses' => 'ComissaoController@editPosicionamento']);
    Route::put('comissoes/atualizar/posicionamento/{id_comissao}/{id_parlamentar}/{origin}',['middleware' => ['permission:parla::comissoes.show.update'],'as' => 'parla::comissoes.update.posicionamento', 'uses' => 'ComissaoController@updatePosicionamento']);

    //TABELA: TIPOS DE PROPOSICAO
    Route::get('tabelas/tipos-proposicao',['middleware' => ['permission:parla::tiposProposicao.index'],'as' => 'parla::tiposProposicao.index', 'uses' => 'TipoProposicaoController@index']);
    Route::get('tabelas/tipos-proposicao/adicionar',['middleware' => ['permission:parla::tiposProposicao.create'],'as' => 'parla::tiposProposicao.create', 'uses' => 'TipoProposicaoController@create']);
    Route::post('tabelas/tipos-proposicao/cadastrar',['middleware' => ['permission:parla::tiposProposicao.store'],'as' => 'parla::tiposProposicao.store', 'uses' => 'TipoProposicaoController@store']);
    Route::get('tabelas/tipos-proposicao/editar/{id}',['middleware' => ['permission:parla::tiposProposicao.edit'],'as' => 'parla::tiposProposicao.edit', 'uses' => 'TipoProposicaoController@edit']);
    Route::put('tabelas/tipos-proposicao/atualizar/{id}',['middleware' => ['permission:parla::tiposProposicao.update'],'as' => 'parla::tiposProposicao.update', 'uses' => 'TipoProposicaoController@update']);
    Route::get('tabelas/tipos-proposicao/excluir/{id}',['middleware' => ['permission:parla::tiposProposicao.destroy'],'as' => 'parla::tiposProposicao.destroy', 'uses' => 'TipoProposicaoController@destroy']);

    //TABELA: TIPOS DE POSICAO
    Route::get('tabelas/tipos-posicao',['middleware' => ['permission:parla::tiposPosicao.index'],'as' => 'parla::tiposPosicao.index', 'uses' => 'TipoPosicaoController@index']);
    Route::get('tabelas/tipos-posicao/adicionar',['middleware' => ['permission:parla::tiposPosicao.create'],'as' => 'parla::tiposPosicao.create', 'uses' => 'TipoPosicaoController@create']);
    Route::post('tabelas/tipos-posicao/cadastrar',['middleware' => ['permission:parla::tiposPosicao.store'],'as' => 'parla::tiposPosicao.store', 'uses' => 'TipoPosicaoController@store']);
    Route::get('tabelas/tipos-posicao/editar/{id}',['middleware' => ['permission:parla::tiposPosicao.edit'],'as' => 'parla::tiposPosicao.edit', 'uses' => 'TipoPosicaoController@edit']);
    Route::put('tabelas/tipos-posicao/atualizar/{id}',['middleware' => ['permission:parla::tiposPosicao.update'],'as' => 'parla::tiposPosicao.update', 'uses' => 'TipoPosicaoController@update']);
    Route::get('tabelas/tipos-posicao/excluir/{id}',['middleware' => ['permission:parla::tiposPosicao.destroy'],'as' => 'parla::tiposPosicao.destroy', 'uses' => 'TipoPosicaoController@destroy']);

    //TABELA: TIPOS DE CONSULTA
    Route::get('tabelas/tipos-consulta',['middleware' => ['permission:parla::tiposConsulta.index'],'as' => 'parla::tiposConsulta.index', 'uses' => 'TipoConsultaController@index']);
    Route::get('tabelas/tipos-consulta/adicionar',['middleware' => ['permission:parla::tiposConsulta.create'],'as' => 'parla::tiposConsulta.create', 'uses' => 'TipoConsultaController@create']);
    Route::post('tabelas/tipos-consulta/cadastrar',['middleware' => ['permission:parla::tiposConsulta.store'],'as' => 'parla::tiposConsulta.store', 'uses' => 'TipoConsultaController@store']);
    Route::get('tabelas/tipos-consulta/editar/{id}',['middleware' => ['permission:parla::tiposConsulta.edit'],'as' => 'parla::tiposConsulta.edit', 'uses' => 'TipoConsultaController@edit']);
    Route::put('tabelas/tipos-consulta/atualizar/{id}',['middleware' => ['permission:parla::tiposConsulta.update'],'as' => 'parla::tiposConsulta.update', 'uses' => 'TipoConsultaController@update']);
    Route::get('tabelas/tipos-consulta/excluir/{id}',['middleware' => ['permission:parla::tiposConsulta.destroy'],'as' => 'parla::tiposConsulta.destroy', 'uses' => 'TipoConsultaController@destroy']);

    //TABELA: TIPOS DE SITUACAO
    Route::get('tabelas/tipos-situacao',['middleware' => ['permission:parla::tipos_situacao.index'],'as' => 'parla::tipos_situacao.index', 'uses' => 'TipoSituacaoController@index']);
    Route::get('tabelas/tipos-situacao/adicionar',['middleware' => ['permission:parla::tipos_situacao.create'],'as' => 'parla::tipos_situacao.create', 'uses' => 'TipoSituacaoController@create']);
    Route::post('tabelas/tipos-situacao/cadastrar',['middleware' => ['permission:parla::tipos_situacao.store'],'as' => 'parla::tipos_situacao.store', 'uses' => 'TipoSituacaoController@store']);
    Route::get('tabelas/tipos-situacao/editar/{id}',['middleware' => ['permission:parla::tipos_situacao.edit'],'as' => 'parla::tipos_situacao.edit', 'uses' => 'TipoSituacaoController@edit']);
    Route::put('tabelas/tipos-situacao/atualizar/{id}',['middleware' => ['permission:parla::tipos_situacao.update'],'as' => 'parla::tipos_situacao.update', 'uses' => 'TipoSituacaoController@update']);
    Route::get('tabelas/tipos-situacao/excluir/{id}',['middleware' => ['permission:parla::tipos_situacao.destroy'],'as' => 'parla::tipos_situacao.destroy', 'uses' => 'TipoSituacaoController@destroy']);


});