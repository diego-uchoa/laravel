<?php




Breadcrumbs::register('prisma::inicio', function($breadcrumbs)
{
    $breadcrumbs->push('Prisma', route('prisma::inicio'));
});

Breadcrumbs::register('prisma::solicitacao.cadastro.index', function($breadcrumbs)
{
    $breadcrumbs->parent('prisma::inicio');
    $breadcrumbs->push('Solicitações de Cadastro', route('prisma::solicitacao.cadastro.index'));
});

Breadcrumbs::register('prisma::solicitacao.cadastro.edit', function($breadcrumbs, $solicitacaoCadastro)
{
    $breadcrumbs->parent('prisma::solicitacao.cadastro.index');
    $breadcrumbs->push('Análise de Solicitação de Cadastro', route('prisma::solicitacao.cadastro.edit', $solicitacaoCadastro->id_solicitacao_cadastro));
});



Breadcrumbs::register('prisma::instituicoes.index', function($breadcrumbs)
{
    $breadcrumbs->parent('prisma::inicio');
    $breadcrumbs->push('Instituições', route('prisma::instituicoes.index'));
});
Breadcrumbs::register('prisma::instituicoes.create', function($breadcrumbs)
{
    $breadcrumbs->parent('prisma::instituicoes.index');
    $breadcrumbs->push('Novo', route('prisma::instituicoes.create'));
});
Breadcrumbs::register('prisma::instituicoes.edit', function($breadcrumbs, $instituicao)
{
    $breadcrumbs->parent('prisma::instituicoes.index');
    $breadcrumbs->push('Editar', route('prisma::instituicoes.edit', $instituicao->no_razao_social));
});

Breadcrumbs::register('prisma::instituicoes.show', function($breadcrumbs, $instituicao)
{
    $breadcrumbs->parent('prisma::instituicoes.index');
    $breadcrumbs->push('Gerenciar', route('prisma::instituicoes.show', $instituicao->no_razao_social));
});

Breadcrumbs::register('prisma::instituicoes.show.minha', function($breadcrumbs, $instituicao)
{
    $breadcrumbs->parent('prisma::inicio');
    $breadcrumbs->push('Minha instituição', route('prisma::instituicoes.show.minha', $instituicao->no_razao_social));
});

Breadcrumbs::register('prisma::instituicoes_responsavel_previsao.index', function($breadcrumbs)
{
    $breadcrumbs->parent('prisma::inicio');
    $breadcrumbs->push('instituicoes Responsáveis por Previsão', route('prisma::instituicoes_responsavel_previsao.index'));
});
Breadcrumbs::register('prisma::instituicoes_responsavel_previsao.create', function($breadcrumbs)
{
    $breadcrumbs->parent('prisma::instituicoes_responsavel_previsao.index');
    $breadcrumbs->push('Novo', route('prisma::instituicoes_responsavel_previsao.create'));
});
Breadcrumbs::register('prisma::instituicoes_responsavel_previsao.edit', function($breadcrumbs, $instituicaoResponsavelPrevisao)
{
    $breadcrumbs->parent('prisma::instituicoes_responsavel_previsao.index');
    $breadcrumbs->push('Editar', route('prisma::instituicoes_responsavel_previsao.edit', $instituicaoResponsavelPrevisao->id_instituicao_responsavel_previsao));
});
?>