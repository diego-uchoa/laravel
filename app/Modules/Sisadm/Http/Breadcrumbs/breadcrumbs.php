<?php


//SISADM
Breadcrumbs::register('sisadm::inicio', function($breadcrumbs)
{
    $breadcrumbs->push('Início', route('sisadm::inicio'));
});


//USUARIOS
Breadcrumbs::register('sisadm::usuarios.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Usuários', route('sisadm::usuarios.index'));
});


//PERFIL
Breadcrumbs::register('sisadm::perfil.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Perfil', route('sisadm::perfis.index'));
});

Breadcrumbs::register('sisadm::perfis.operacoes', function($breadcrumbs, $perfil)
{
    $breadcrumbs->parent('sisadm::perfil.index');
    $breadcrumbs->push('Operações', route('sisadm::perfis.operacoes', $perfil->id_perfil));
});


//SISTEMAS
Breadcrumbs::register('sisadm::sistemas.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Sistema', route('sisadm::sistemas.index'));
});

Breadcrumbs::register('sisadm::sistemas.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::sistemas.index');
    $breadcrumbs->push('Novo', route('sisadm::sistemas.create'));
});

Breadcrumbs::register('sisadm::sistemas.edit', function($breadcrumbs, $sistema)
{
    $breadcrumbs->parent('sisadm::sistemas.index');
    $breadcrumbs->push('Editar', route('sisadm::sistemas.edit', $sistema->id_sistema));
});

Breadcrumbs::register('sisadm::sistemas.orgaos', function($breadcrumbs, $sistema)
{
    $breadcrumbs->parent('sisadm::sistemas.index');
    $breadcrumbs->push('Órgãos', route('sisadm::sistemas.orgaos', $sistema->id_sistema));
});


//OPERACOES
Breadcrumbs::register('sisadm::operacoes.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Operação', route('sisadm::operacoes.index'));
});


//ITENS DE MENU
Breadcrumbs::register('sisadm::itens_menu.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Item de Menu', route('sisadm::itens_menu.index'));
});


Breadcrumbs::register('sisadm::itens_menu.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::itens_menu.index');
    $breadcrumbs->push('Novo', route('sisadm::itens_menu.create'));
});

Breadcrumbs::register('sisadm::itens_menu.edit', function($breadcrumbs, $itemMenu)
{
    $breadcrumbs->parent('sisadm::itens_menu.index');
    $breadcrumbs->push('Editar', route('sisadm::itens_menu.edit', $itemMenu->no_item_menu));
});


//AVISO SISTEMA
Breadcrumbs::register('sisadm::aviso_sistema.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Aviso Sistema', route('sisadm::aviso_sistema.index'));
});






//FERIADO
Breadcrumbs::register('sisadm::feriado.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Feriado', route('sisadm::feriado.index'));
});

Breadcrumbs::register('sisadm::feriado.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::feriado.index');
    $breadcrumbs->push('Novo', route('sisadm::feriado.create'));
});

Breadcrumbs::register('sisadm::feriado.edit', function($breadcrumbs, $feriado)
{
    $breadcrumbs->parent('sisadm::feriado.index');
    $breadcrumbs->push($feriado->no_feriado, route('sisadm::feriado.edit', $feriado->id));
});


//AVISO USUARIO
Breadcrumbs::register('sisadm::aviso_usuario.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Aviso Usuário', route('sisadm::aviso_usuario.index'));
});

Breadcrumbs::register('sisadm::aviso_usuario.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::aviso_usuario.index');
    $breadcrumbs->push('Novo', '');
});

Breadcrumbs::register('sisadm::aviso_usuario.edit', function($breadcrumbs, $aviso_usuario)
{
    $breadcrumbs->parent('sisadm::aviso_usuario.index');
    $breadcrumbs->push('Editar','');
});


//OPERACAO FAVORITA
Breadcrumbs::register('sisadm::operacao_favorita.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Operação Favorita', route('sisadm::operacao_favorita.index'));
});

Breadcrumbs::register('sisadm::operacao_favorita.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::operacao_favorita.index');
    $breadcrumbs->push('Novo', route('sisadm::operacao_favorita.create'));
});

Breadcrumbs::register('sisadm::operacao_favorita.edit', function($breadcrumbs, $operacao_favorita)
{
    $breadcrumbs->parent('sisadm::operacao_favorita.index');
    $breadcrumbs->push($operacao_favorita->operacao->no_operacao, route('sisadm::operacao_favorita.edit', $operacao_favorita->id));
});


//EVENTO
Breadcrumbs::register('sisadm::evento.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Evento', route('sisadm::evento.index'));
});

Breadcrumbs::register('sisadm::evento.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::evento.index');
    $breadcrumbs->push('Novo', route('sisadm::evento.create'));
});

Breadcrumbs::register('sisadm::evento.edit', function($breadcrumbs, $evento)
{
    $breadcrumbs->parent('sisadm::evento.index');
    $breadcrumbs->push($evento->no_evento, route('sisadm::evento.edit', $evento->id));
});


//INCONSISTENCIA

Breadcrumbs::register('sisadm::inconsistencia.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Inconsistencia', route('sisadm::inconsistencia.index'));
});


//AUDITORIA

Breadcrumbs::register('sisadm::auditoria.search', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Auditoria', route('sisadm::auditoria.search'));
});


Breadcrumbs::register('sisadm::orgaos.index', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::inicio');
    $breadcrumbs->push('Orgao', route('sisadm::orgaos.index'));
});
Breadcrumbs::register('sisadm::orgaos.create', function($breadcrumbs)
{
    $breadcrumbs->parent('sisadm::orgaos.index');
    $breadcrumbs->push('Novo', route('sisadm::orgaos.create'));
});
Breadcrumbs::register('sisadm::orgaos.edit', function($breadcrumbs, $orgao)
{
    $breadcrumbs->parent('sisadm::orgaos.index');
    $breadcrumbs->push('Editar', route('sisadm::orgaos.edit', $orgao->id_orgao));
});
?>