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

//Rotas públicas
Route::group(['prefix' => 'prisma'], function () {
    Route::get('solicitar-cadastro', ['as' => 'prisma::solicitacao.cadastro.create', 'uses' => 'SolicitacaoCadastroController@create']);
    Route::get('solicitar-cadastro/instituicao/dados/{cnpj}', ['as' => 'prisma::solicitacao.cadastro.instituicao.dados', 'uses' => 'SolicitacaoCadastroController@findDadosInstituicaoWsByCNPJ']);
    Route::post('solicitar-cadastro/store', ['as' => 'prisma::solicitacao.cadastro.store', 'uses' => 'SolicitacaoCadastroController@store']);
    Route::get('solicitar-cadastro/confirmacao',['as' => 'prisma::solicitacao.cadastro.confirmacao', function () {
        return view('prisma::solicitacoes_cadastro.solicitacoes.confirmacao_envio');
    }]);


    //Route::get('login', ['as' => 'prisma::login', 'uses' => 'LoginExterno@showLoginForm']);
    Route::get('login',['as' => 'prisma::login', function () {
        return view('prisma::auth.login');
    }]);


    // Route::get('email',['as' => 'prisma::login', function () {
    //     return view('prisma::layouts.emails.email-solicitacao-cadastro-aprovada',['cnpj'=>'123', 'instituicao' => 'instituicao', 'nome_fantasia' => 'nome fantasia', 'nome_responsavel' => 'Nome do Responsavel', 'cpf' => '0002215465-44' ]);
    // }]);

});


Route::group(['prefix' => 'prisma', 'middleware' => ['aviso', 'menu', 'auth']], function () {
    Route::get('/', ['middleware' => ['permission:prisma::inicio'],'as' => 'prisma::inicio', 'uses' => 'PrismaController@index']);

    /*GERENCIAR SOLICITACOES DE CADASTRO*/
    Route::get('solicitacoes-cadastro',['middleware' => ['permission:prisma::solicitacao.cadastro.index'],'as' => 'prisma::solicitacao.cadastro.index', 'uses' => 'SolicitacaoCadastroController@index']);
    Route::get('solicitacoes-cadastro/editar/{id}',['middleware' => ['permission:prisma::solicitacao.cadastro.edit'],'as' => 'prisma::solicitacao.cadastro.edit', 'uses' => 'SolicitacaoCadastroController@edit']);
    Route::get('solicitacoes-cadastro/destroy/{id}',['middleware' => ['permission:prisma::solicitacao.cadastro.destroy'],'as' => 'prisma::solicitacao.cadastro.destroy', 'uses' => 'SolicitacaoCadastroController@destroy']);
    Route::put('solicitacoes-cadastro/update/{id}', ['middleware' => ['permission:prisma::solicitacao.cadastro.edit'],'as' => 'prisma::solicitacao.cadastro.update', 'uses' => 'SolicitacaoCadastroController@update']);
    Route::get('solicitacoes-cadastro/list',['middleware' => ['permission:prisma::solicitacao.cadastro.index'],'as' => 'prisma::solicitacao.cadastro.list', 'uses' => 'SolicitacaoCadastroController@list']);
    Route::put('solicitacoes-cadastro/aprovar', ['middleware' => ['permission:prisma::solicitacao.cadastro.edit'],'as' => 'prisma::solicitacao.cadastro.aprovar', 'uses' => 'SolicitacaoCadastroController@aprovar']);
    Route::put('solicitacoes-cadastro/rejeitar', ['middleware' => ['permission:prisma::solicitacao.cadastro.edit'],'as' => 'prisma::solicitacao.cadastro.rejeitar', 'uses' => 'SolicitacaoCadastroController@rejeitar']);

    /*GERENCIAR INSTITUICOES*/
    Route::get('instituicoes',['middleware' => ['permission:prisma::instituicoes.index'],'as' => 'prisma::instituicoes.index', 'uses' => 'InstituicaoController@index']);
    Route::get('minha-instituicao/{id?}',['middleware' => ['permission:prisma::instituicoes.show.minha'],'as' => 'prisma::instituicoes.show.minha', 'uses' => 'InstituicaoController@show']);
    Route::get('instituicoes/gerenciar/{id?}',['middleware' => ['permission:prisma::instituicoes.show.todas'],'as' => 'prisma::instituicoes.show', 'uses' => 'InstituicaoController@show']);
    Route::get('instituicoes/editar/nome-relatorio/{id}',['middleware' => ['permission:prisma::instituicoes.edit.nome_relatorio'],'as' => 'prisma::instituicoes.edit.nome_relatorio', 'uses' => 'InstituicaoController@editNomeRelatorio']);
    Route::put('instituicoes/atualizar/nome-relatorio/{id}',['middleware' => ['permission:prisma::instituicoes.edit.nome_relatorio'],'as' => 'prisma::instituicoes.update.nome_relatorio', 'uses' => 'InstituicaoController@updateNomeRelatorio']);
    Route::get('instituicoes/editar/instituicao-responsavel-previsao/{id}',['middleware' => ['permission:prisma::instituicoes.edit.instituicao_responsavel_previsao'],'as' => 'prisma::instituicoes.edit.instituicao_responsavel_previsao', 'uses' => 'InstituicaoController@editInstituicaoResponsavelPrevisao']);
    Route::put('instituicoes/atualizar/instituicao-responsavel-previsao/{id}',['middleware' => ['permission:prisma::instituicoes.edit.instituicao_responsavel_previsao'],'as' => 'prisma::instituicoes.update.instituicao_responsavel_previsao', 'uses' => 'InstituicaoController@updateInstituicaoResponsavelPrevisao']);
    Route::get('instituicoes/excluir/instituicao-responsavel-previsao/{id}',['middleware' => ['permission:prisma::instituicoes.destroy.instituicao_responsavel_previsao'],'as' => 'prisma::instituicoes.destroy.instituicao_responsavel_previsao', 'uses' => 'InstituicaoController@destroyInstituicaoResponsavelPrevisao']);

    /*GERENCIAR RESPONSAVEL*/
    Route::get('usuarios/adicionar-responsavel/{id}', ['middleware' => ['permission:prisma::usuarios.create.responsavel'],'as' => 'prisma::usuarios.create.responsavel', 'uses' => 'ControleUsuarioController@createResponsavel']);
    Route::post('usuarios/cadastrar-responsavel', ['middleware' => ['permission:prisma::usuarios.create.responsavel'],'as' => 'prisma::usuarios.store.responsavel', 'uses' => 'ControleUsuarioController@storeResponsavel']);
    Route::get('usuarios/editar-responsavel/{id}', ['middleware' => ['permission:prisma::usuarios.edit.responsavel'],'as' => 'prisma::usuarios.edit.responsavel', 'uses' => 'ControleUsuarioController@editResponsavel']);
    Route::put('usuarios/atualizar-responsavel/{id}', ['middleware' => ['permission:prisma::usuarios.edit.responsavel'],'as' => 'prisma::usuarios.update.responsavel', 'uses' => 'ControleUsuarioController@updateResponsavel']);
    Route::get('usuarios/substituir-responsavel/{id}', ['middleware' => ['permission:prisma::usuarios.change.responsavel'],'as' => 'prisma::usuarios.change.responsavel', 'uses' => 'ControleUsuarioController@changeResponsavel']);
    Route::post('usuarios/alterar-responsavel', ['middleware' => ['permission:prisma::usuarios.change.responsavel'],'as' => 'prisma::usuarios.alter.responsavel', 'uses' => 'ControleUsuarioController@alterResponsavel']);
    Route::get('usuarios/excluir-responsavel/{id}', ['middleware' => ['permission:prisma::usuarios.destroy.responsavel'],'as' => 'prisma::usuarios.destroy.responsavel', 'uses' => 'ControleUsuarioController@destroyResponsavel']);

    /*GERENCIAR EDITORES*/
    Route::get('usuarios/adicionar-editor/{id}', ['middleware' => ['permission:prisma::usuarios.create.editor'],'as' => 'prisma::usuarios.create.editor', 'uses' => 'ControleUsuarioController@createEditor']);
    Route::post('usuarios/cadastrar-editor', ['middleware' => ['permission:prisma::usuarios.create.editor'],'as' => 'prisma::usuarios.store.editor', 'uses' => 'ControleUsuarioController@storeEditor']);
    Route::get('usuarios/editar-editor/{id}', ['middleware' => ['permission:prisma::usuarios.edit.editor'],'as' => 'prisma::usuarios.edit.editor', 'uses' => 'ControleUsuarioController@editEditor']);
    Route::put('usuarios/atualizar-editor/{id}', ['middleware' => ['permission:prisma::usuarios.edit.editor'],'as' => 'prisma::usuarios.update.editor', 'uses' => 'ControleUsuarioController@updateEditor']);
    Route::get('usuarios/excluir-editor/{id}', ['middleware' => ['permission:prisma::usuarios.destroy.editor'],'as' => 'prisma::usuarios.destroy.editor', 'uses' => 'ControleUsuarioController@destroyEditor']);

    /*GERENCIAR INSTITUICOES RESPONSAVEL PELA PREVISAO*/
    Route::get('instituicoes-responsavel-previsao',['as' => 'prisma::instituicoes_responsavel_previsao.index', 'uses' => 'InstituicaoResponsavelPrevisaoController@index']);
    Route::get('instituicoes-responsavel-previsao/adicionar',['as' => 'prisma::instituicoes_responsavel_previsao.create', 'uses' => 'InstituicaoResponsavelPrevisaoController@create']);
    Route::post('instituicoes-responsavel-previsao/cadastrar',['as' => 'prisma::instituicoes_responsavel_previsao.store', 'uses' => 'InstituicaoResponsavelPrevisaoController@store']);
    Route::get('instituicoes-responsavel-previsao/editar/{id}',['as' => 'prisma::instituicoes_responsavel_previsao.edit', 'uses' => 'InstituicaoResponsavelPrevisaoController@edit']);
    Route::put('instituicoes-responsavel-previsao/atualizar/{id}',['as' => 'prisma::instituicoes_responsavel_previsao.update', 'uses' => 'InstituicaoResponsavelPrevisaoController@update']);
    Route::get('instituicoes-responsavel-previsao/excluir/{id}',['as' => 'prisma::instituicoes_responsavel_previsao.destroy', 'uses' => 'InstituicaoResponsavelPrevisaoController@destroy']);





    // Route::get('teste',['as' => 'prisma::solicitacao.cadastro.teste', 'uses' => 'InstituicaoResponsavelPrevisaoController@listaTodosSemVinculo']);

    // Route::get('instituicoes/new',['as' => 'prisma::instituicoes.create', 'uses' => 'InstituicaoController@create']);
    // Route::post('instituicoes/store',['as' => 'prisma::instituicoes.store', 'uses' => 'InstituicaoController@store']);
    // Route::get('instituicoes/edit/{id}',['as' => 'prisma::instituicoes.edit', 'uses' => 'InstituicaoController@edit']);
    // Route::put('instituicoes/update/{id}',['as' => 'prisma::instituicoes.update', 'uses' => 'InstituicaoController@update']);
    // Route::get('instituicoes/destroy/{id}',['as' => 'prisma::instituicoes.destroy', 'uses' => 'InstituicaoController@destroy']);
    // Route::get('instituicoes/list',['as' => 'prisma::instituicoes.list', 'uses' => 'InstituicaoController@list']);


    // Route::get('usuarios', ['as' => 'prisma::usuarios.index', 'uses' => 'ControleUsuarioController@index']);
    // Route::get('usuarios/records', ['as' => 'prisma::usuarios.records', 'uses' => 'ControleUsuarioController@records']);
    // Route::get('usuarios/new', ['as' => 'prisma::usuarios.create', 'uses' => 'ControleUsuarioController@create']);
    // Route::post('usuarios/store', ['as' => 'prisma::usuarios.store', 'uses' => 'ControleUsuarioController@store']);
    // Route::get('usuarios/edit/{id}', ['as' => 'prisma::usuarios.edit', 'uses' => 'ControleUsuarioController@edit']);
    // Route::put('usuarios/update/{id}', ['as' => 'prisma::usuarios.update', 'uses' => 'ControleUsuarioController@update']);
    // Route::get('usuarios/destroy/{id}', ['as' => 'prisma::usuarios.destroy', 'uses' => 'ControleUsuarioController@destroy']);
    Route::get('usuarios/perfis/{id}', ['as' => 'prisma::usuarios.perfis', 'uses' => 'ControleUsuarioController@perfis']);
    Route::post('usuarios/perfis/{id}/store', ['as' => 'prisma::usuarios.perfis.store', 'uses' => 'ControleUsuarioController@storePerfil']);
    Route::get('usuarios/perfis/{id}/revoke/{role_id}', ['as' => 'prisma::usuarios.perfis.revoke', 'uses' => 'ControleUsuarioController@revokePerfil']);
    Route::get('usuarios/verifica-perfil/{nr_cpf}/{no_sistema}',['uses' => 'UsuariosController@findUsuarioBySistema']);

    // Route::get('editores', ['as' => 'prisma::usuarios.editores', 'uses' => 'ControleUsuarioController@editores']);


});