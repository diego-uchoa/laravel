<?php

//SISMED
Breadcrumbs::register('sismed::inicio', function($breadcrumbs)
{
    $breadcrumbs->push('Início', route('sismed::inicio'));
});

//SERVIDOR

Breadcrumbs::register('sismed::servidor.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sismed::inicio');
    $breadcrumbs->push('Servidor', route('sismed::servidor.index'));
});

Breadcrumbs::register('sismed::servidor.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sismed::servidor.index');
    $breadcrumbs->push('Novo', route('sismed::servidor.create'));
});

Breadcrumbs::register('sismed::servidor.atestados', function($breadcrumbs, $servidor)
{
    $breadcrumbs->parent('sismed::servidor.index');
    $breadcrumbs->push($servidor->no_servidor, route('sismed::servidor.atestados', $servidor->id_servidor));
});

Breadcrumbs::register('sismed::servidor.atestado.edit', function($breadcrumbs, $servidor)
{
    $breadcrumbs->parent('sismed::servidor.atestados',$servidor);
    $breadcrumbs->push('Editar Atestado');
});

Breadcrumbs::register('sismed::servidor.atestado.cancelar', function($breadcrumbs, $servidor)
{
    $breadcrumbs->parent('sismed::servidor.atestados',$servidor);
    $breadcrumbs->push('Cancelar Atestado');
});

Breadcrumbs::register('sismed::atestado.index', function($breadcrumbs)
{
    $breadcrumbs->push('Atestados', route('sismed::atestado.index'));
});

Breadcrumbs::register('sismed::atestado.show', function($breadcrumbs)
{
    $breadcrumbs->push('Meus Atestados', route('sismed::atestado.show'));
});

//RELATORIO

Breadcrumbs::register('sismed::relatorio.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sismed::inicio');
    $breadcrumbs->push('Relatórios', route('sismed::relatorio.index'));
});