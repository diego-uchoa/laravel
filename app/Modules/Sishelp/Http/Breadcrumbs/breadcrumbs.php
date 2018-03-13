<?php

//SISADM
Breadcrumbs::register('sishelp::home', function($breadcrumbs)
{
    $breadcrumbs->push('Início', route('sishelp::inicio'));
});

//AJUDA ARQUIVO

Breadcrumbs::register('sishelp::ajuda_arquivo.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sishelp::home');
    $breadcrumbs->push('Ajuda Arquivo', route('sishelp::ajuda_arquivo.index'));
});

Breadcrumbs::register('sishelp::ajuda_arquivo.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sishelp::ajuda_arquivo.index');
    $breadcrumbs->push('Novo', route('sishelp::ajuda_arquivo.create'));
});

Breadcrumbs::register('sishelp::ajuda_arquivo.edit', function($breadcrumbs, $ajuda_arquivo)
{
    $breadcrumbs->parent('sishelp::ajuda_arquivo.index');
    $breadcrumbs->push($ajuda_arquivo->sistema->no_sistema, route('sishelp::ajuda_arquivo.edit', $ajuda_arquivo->id));
});


//AJUDA FAQ

Breadcrumbs::register('sishelp::ajuda_faq.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sishelp::home');
    $breadcrumbs->push('Ajuda FAQ', route('sishelp::ajuda_faq.index'));
});

Breadcrumbs::register('sishelp::ajuda_faq.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sishelp::ajuda_faq.index');
    $breadcrumbs->push('Novo', route('sishelp::ajuda_faq.create'));
});

Breadcrumbs::register('sishelp::ajuda_faq.edit', function($breadcrumbs, $ajuda_faq)
{
    $breadcrumbs->parent('sishelp::ajuda_faq.index');
    $breadcrumbs->push($ajuda_faq->sistema->no_sistema, route('sishelp::ajuda_faq.edit', $ajuda_faq->id));
});


//AJUDA GERAL

Breadcrumbs::register('sishelp::ajuda_geral.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sishelp::home');
    $breadcrumbs->push('Ajuda Geral', route('sishelp::ajuda_geral.index'));
});

Breadcrumbs::register('sishelp::ajuda_geral.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sishelp::ajuda_geral.index');
    $breadcrumbs->push('Novo', route('sishelp::ajuda_geral.create'));
});

Breadcrumbs::register('sishelp::ajuda_geral.edit', function($breadcrumbs, $ajuda_geral)
{
    $breadcrumbs->parent('sishelp::ajuda_geral.index');
    $breadcrumbs->push($ajuda_geral->sistema->no_sistema, route('sishelp::ajuda_geral.edit', $ajuda_geral->id));
});

?>