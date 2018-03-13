<?php
Breadcrumbs::register('gescon::inicio', function($breadcrumbs)
{
    $breadcrumbs->push('Início', route('gescon::inicio'));
});

Breadcrumbs::register('gescon::modalidades.index', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Modalidade', route('gescon::modalidades.index'));
});
Breadcrumbs::register('gescon::modalidades.create', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::modalidades.index');
    $breadcrumbs->push('Novo', route('gescon::modalidades.create'));
});
Breadcrumbs::register('gescon::modalidades.edit', function($breadcrumbs, $modalidade)
{
    $breadcrumbs->parent('gescon::modalidades.index');
    $breadcrumbs->push('Editar', route('gescon::modalidades.edit', $modalidade->id_modalidade));
});

Breadcrumbs::register('gescon::contratadas.index', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Contratada', route('gescon::contratadas.index'));
});
Breadcrumbs::register('gescon::contratadas.create', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::contratadas.index');
    $breadcrumbs->push('Novo', route('gescon::contratadas.create'));
});
Breadcrumbs::register('gescon::contratadas.edit', function($breadcrumbs, $contratada)
{
    $breadcrumbs->parent('gescon::contratadas.index');
    $breadcrumbs->push('Editar', route('gescon::contratadas.edit', $contratada->id_contratada));
});

Breadcrumbs::register('gescon::contratantes.index', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Contratante', route('gescon::contratantes.index'));
});
Breadcrumbs::register('gescon::contratantes.create', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::contratantes.index');
    $breadcrumbs->push('Novo', route('gescon::contratantes.create'));
});
Breadcrumbs::register('gescon::contratantes.representante.associate_representante', function($breadcrumbs, $contratante)
{
    $breadcrumbs->parent('gescon::contratantes.index');
    $breadcrumbs->push('Editar', route('gescon::contratantes.representante.associate_representante', $contratante->id_contratante));
});
Breadcrumbs::register('gescon::contratantes.usuario.associate_usuario', function($breadcrumbs, $contratante)
{
    $breadcrumbs->parent('gescon::contratantes.index');
    $breadcrumbs->push('Editar', route('gescon::contratantes.usuario.associate_usuario', $contratante->id_contratante));
});
Breadcrumbs::register('gescon::contratantes.assinante.associate_assinante', function($breadcrumbs, $contratante)
{
    $breadcrumbs->parent('gescon::contratantes.index');
    $breadcrumbs->push('Editar', route('gescon::contratantes.assinante.associate_assinante', $contratante->id_contratante));
});
Breadcrumbs::register('gescon::contratos.index', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Contrato', route('gescon::contratos.index'));
});
Breadcrumbs::register('gescon::contratos.create', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::contratos.index');
    $breadcrumbs->push('Novo', route('gescon::contratos.create'));
});
Breadcrumbs::register('gescon::contratos.edit', function($breadcrumbs, $contrato)
{
    $breadcrumbs->parent('gescon::contratos.index');
    $breadcrumbs->push('Editar', route('gescon::contratos.edit', $contrato->id_contrato));
});

Breadcrumbs::register('gescon::fiscais.index', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Fiscal', route('gescon::fiscais.index'));
});
Breadcrumbs::register('gescon::fiscais.create', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::fiscais.index');
    $breadcrumbs->push('Novo', route('gescon::fiscais.create'));
});
Breadcrumbs::register('gescon::fiscais.edit', function($breadcrumbs, $fiscal)
{
    $breadcrumbs->parent('gescon::fiscais.index');
    $breadcrumbs->push('Editar', route('gescon::fiscais.edit', $fiscal->id_fiscal));
});

Breadcrumbs::register('gescon::tipos_itens_contratacao.index', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Objeto de Contratação', route('gescon::tipos_itens_contratacao.index'));
});
Breadcrumbs::register('gescon::tipos_itens_contratacao.create', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::tipos_itens_contratacao.index');
    $breadcrumbs->push('Novo', route('gescon::tipos_itens_contratacao.create'));
});
Breadcrumbs::register('gescon::tipos_itens_contratacao.edit', function($breadcrumbs, $tipoItemContratacao)
{
    $breadcrumbs->parent('gescon::tipos_itens_contratacao.index');
    $breadcrumbs->push('Editar', route('gescon::tipos_itens_contratacao.edit', $tipoItemContratacao->id_tipo_item_contratacao));
});

Breadcrumbs::register('gescon::unidades_medida_item_contratacao.index', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Unidade de Medida', route('gescon::unidades_medida_item_contratacao.index'));
});
Breadcrumbs::register('gescon::unidades_medida_item_contratacao.create', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::unidades_medida_item_contratacao.index');
    $breadcrumbs->push('Novo', route('gescon::unidades_medida_item_contratacao.create'));
});
Breadcrumbs::register('gescon::unidades_medida_item_contratacao.edit', function($breadcrumbs, $unidadeMedidaItemContratacao)
{
    $breadcrumbs->parent('gescon::unidades_medida_item_contratacao.index');
    $breadcrumbs->push('Editar', route('gescon::unidades_medida_item_contratacao.edit', $unidadeMedidaItemContratacao->id_unidade_medida_item_contratacao));
});
Breadcrumbs::register('gescon::relatorios.comparativo_contrato', function($breadcrumbs)
{
    $breadcrumbs->parent('gescon::inicio');
    $breadcrumbs->push('Relatórios', route('gescon::relatorios.comparativo_contrato'));
});
?>