<?php

//SISFONE
Breadcrumbs::register('sisfone::home', function($breadcrumbs)
{
    $breadcrumbs->push('Início', route('sisfone::inicio'));
});

//TELEFONE

Breadcrumbs::register('sisfone::telefone.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisfone::home');
    $breadcrumbs->push('Telefone', route('sisfone::telefone.index'));
});

Breadcrumbs::register('sisfone::telefone.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisfone::telefone.index');
    $breadcrumbs->push('Novo', route('sisfone::telefone.create'));
});

Breadcrumbs::register('sisfone::telefone.edit', function($breadcrumbs, $telefone)
{
    $breadcrumbs->parent('sisfone::telefone.index');
    $breadcrumbs->push($telefone->tx_telefone, route('sisfone::telefone.edit', $telefone->id));
});



?>