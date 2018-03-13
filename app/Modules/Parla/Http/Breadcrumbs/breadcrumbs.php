<?php


Breadcrumbs::register('parla::inicio', function($breadcrumbs)
{
    $breadcrumbs->push('Parla', route('parla::inicio'));
});

Breadcrumbs::register('parla::parlamentares.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Parlamentares', route('parla::parlamentares.index'));
});

Breadcrumbs::register('parla::parlamentares.show', function($breadcrumbs, $parlamentar)
{
    $breadcrumbs->parent('parla::parlamentares.index');
    $breadcrumbs->push('Perfil', route('parla::parlamentares.show', $parlamentar->id_parlamentar));
});


Breadcrumbs::register('parla::proposicoes.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Proposições', route('parla::proposicoes.index'));
});

Breadcrumbs::register('parla::proposicoes.show', function($breadcrumbs, $proposicao)
{
    $breadcrumbs->parent('parla::proposicoes.index');
    $breadcrumbs->push('Detalhes', route('parla::proposicoes.show', $proposicao->id_proposicao));
});

Breadcrumbs::register('parla::proposicoes.create', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::proposicoes.index');
    $breadcrumbs->push('Adicionar', route('parla::proposicoes.create'));
});

Breadcrumbs::register('parla::proposicoes.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::proposicoes.index');
    $breadcrumbs->push('Editar', route('parla::proposicoes.edit'));
});



Breadcrumbs::register('parla::consultasMf.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Consultas ao MF', route('parla::consultasMf.index'));
});

Breadcrumbs::register('parla::consultasMf.create', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::consultasMf.index');
    $breadcrumbs->push('Adicionar', route('parla::consultasMf.create'));
});

Breadcrumbs::register('parla::consultasMf.edit', function($breadcrumbs, $consultaMf)
{
    $breadcrumbs->parent('parla::consultasMf.index');
    $breadcrumbs->push('Editar', route('parla::consultasMf.edit', $consultaMf->id_consultamf));
});

Breadcrumbs::register('parla::consultasMf.relatorio', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::consultasMf.index');
    $breadcrumbs->push('Relatórios', route('parla::consultasMf.relatorio'));
});




Breadcrumbs::register('parla::respostas_mf.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Respostas do MF', route('parla::respostas_mf.index'));
});
Breadcrumbs::register('parla::respostas_mf.create', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::respostas_mf.index');
    $breadcrumbs->push('Adicionar', route('parla::respostas_mf.create'));
});
Breadcrumbs::register('parla::respostas_mf.edit', function($breadcrumbs, $respostaMf)
{
    $breadcrumbs->parent('parla::respostas_mf.index');
    $breadcrumbs->push('Editar', route('parla::respostas_mf.edit', $respostaMf->id_resposta_mf));
});



Breadcrumbs::register('parla::tiposProposicao.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Tipos de Proposição', route('parla::tiposProposicao.index'));
});

Breadcrumbs::register('parla::tiposProposicao.create', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::tiposProposicao.index');
    $breadcrumbs->push('Novo', route('parla::tiposProposicao.create'));
});

Breadcrumbs::register('parla::tiposProposicao.edit', function($breadcrumbs, $tipoProposicao)
{
    $breadcrumbs->parent('parla::tiposProposicao.index');
    $breadcrumbs->push('Editar', route('parla::tiposProposicao.edit', $tipoProposicao->id_tipoproposicao));
});



Breadcrumbs::register('parla::tiposPosicao.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Tipos de Posição', route('parla::tiposPosicao.index'));
});

Breadcrumbs::register('parla::tiposPosicao.create', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::tiposPosicao.index');
    $breadcrumbs->push('Novo', route('parla::tiposPosicao.create'));
});

Breadcrumbs::register('parla::tiposPosicao.edit', function($breadcrumbs, $tipoPosicao)
{
    $breadcrumbs->parent('parla::tiposPosicao.index');
    $breadcrumbs->push('Editar', route('parla::tiposPosicao.edit', $tipoPosicao->id_tipoposicao));
});



Breadcrumbs::register('parla::tiposConsulta.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Tipos de Consulta', route('parla::tiposConsulta.index'));
});

Breadcrumbs::register('parla::tiposConsulta.create', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::tiposConsulta.index');
    $breadcrumbs->push('Novo', route('parla::tiposConsulta.create'));
});

Breadcrumbs::register('parla::tiposConsulta.edit', function($breadcrumbs, $tipoConsulta)
{
    $breadcrumbs->parent('parla::tiposConsulta.index');
    $breadcrumbs->push('Editar', route('parla::tiposConsulta.edit', $tipoConsulta->id_tipoconsulta));
});


Breadcrumbs::register('parla::tipos_situacao.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Tipos de Situação', route('parla::tipos_situacao.index'));
});
Breadcrumbs::register('parla::tipos_situacao.create', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::tipos_situacao.index');
    $breadcrumbs->push('Novo', route('parla::tipos_situacao.create'));
});
Breadcrumbs::register('parla::tipos_situacao.edit', function($breadcrumbs, $tipoSituacao)
{
    $breadcrumbs->parent('parla::tipos_situacao.index');
    $breadcrumbs->push('Editar', route('parla::tipos_situacao.edit', $tipoSituacao->id_tipo_situacao));
});

Breadcrumbs::register('parla::comissoes.index', function($breadcrumbs)
{
    $breadcrumbs->parent('parla::inicio');
    $breadcrumbs->push('Comissões', route('parla::comissoes.index'));
});
Breadcrumbs::register('parla::comissoes.show', function($breadcrumbs, $comissao)
{
    $breadcrumbs->parent('parla::comissoes.index');
    $breadcrumbs->push('Composição', route('parla::comissoes.show', $comissao->id_comissao));
});
?>