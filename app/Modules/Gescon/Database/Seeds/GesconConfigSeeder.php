<?php

namespace App\Modules\Gescon\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Sisadm\Models\User;

class GesconConfigSeeder extends Seeder
{
    
    //CONSTANTES DO SISTEMA
    const SISTEMA = 'GESCON';
    const SISTEMA_DESCRICAO = 'Gescon';
    const SISTEMA_MODULO = 'gescon';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->command->info('..........................'. self::SISTEMA .' ..........................');
        
        /***********************************************************************************************
        /*  BUSCA SISTEMA ANTIGO
        /*
        /***********************************************************************************************/
        $sistemaAnterior = \App\Modules\Sisadm\Models\Sistema::where('no_sistema',self::SISTEMA)->first();

        if ($sistemaAnterior) {

        $this->command->info('Limpando Informações do Sistema '. self::SISTEMA .' ...');

        /***********************************************************************************************
        /*  LIMPA DEMAIS TABELAS DO SISTEMA
        /*
        /***********************************************************************************************/
        \App\Modules\Sisadm\Models\Perfil::where('id_sistema',$sistemaAnterior->id_sistema)->delete();
        \App\Modules\Sisadm\Models\Operacao::where('id_sistema',$sistemaAnterior->id_sistema)->delete();
        \App\Modules\Sisadm\Models\ItemMenu::where('id_sistema',$sistemaAnterior->id_sistema)->delete();

        /***********************************************************************************************
        /*  LIMPA TABELAS SISTEMA
        /*
        /***********************************************************************************************/
        $sistemaAnterior->delete();

        }

        /***********************************************************************************************
        /*  SISTEMA
        /*
        /***********************************************************************************************/
        $sistema = factory(\App\Modules\Sisadm\Models\Sistema::class)->create([
            'no_sistema' => self::SISTEMA,
            'ds_sistema' => self::SISTEMA_DESCRICAO,
            'tx_beneficio' => 'Sistema responsável por gerenciar os contratos do Ministério da Fazenda',
            'tx_publico' => 'Servidores do Ministério da Fazenda',
            'co_esquema' => 'spoa_portal_siscontratos',
            'sn_ativo' => true,
            'sn_tela_inicial' => true,
            'no_responsavel' => 'André Veras, André Boaro, Alan Melo, Luisa Palmeira',
            'tx_email_responsavel' => 'andre.veras@fazenda.gov.br, andre.boaro@fazenda.gov.br, alan.melo@fazenda.gov.br, luisa.palmeira@fazenda.gov.br',
            'id_area' => 3,
            'nr_ordem' => 5
        ]);      

        /***********************************************************************************************
        /*  PERFIL
        /*
        /***********************************************************************************************/
        $perfil1 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Gestor',
            'ds_perfil' => self::SISTEMA.'-Gestor do Sistema',
            'id_sistema' => $sistema->id_sistema
        ]);

        
        $perfil2 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Cadastrador',
            'ds_perfil' => self::SISTEMA.'-Cadastrador do Sistema',
            'id_sistema' => $sistema->id_sistema
        ]);

        $perfil3 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Consulta',
            'ds_perfil' => self::SISTEMA.'-Consulta do Sistema',
            'id_sistema' => $sistema->id_sistema
        ]);
        
        
        /***********************************************************************************************
        /*  OPERACAO
        /*
        /***********************************************************************************************/
        
        //Operação INICIAL
        $operacao0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::inicio',
            'ds_operacao'=> 'Início',
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::modalidades.index',
            'ds_operacao'=> 'Modalidade',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::modalidades.store',
            'ds_operacao'=> 'Adicionar Modalidade',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::modalidades.edit',
            'ds_operacao'=> 'Editar Modalidade',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao4 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::modalidades.destroy',
            'ds_operacao'=> 'Excluir Modalidade',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao5 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratadas.index',
            'ds_operacao'=> 'Contratada',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao6 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratadas.store',
            'ds_operacao'=> 'Adicionar Contratada',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao7 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratadas.edit',
            'ds_operacao'=> 'Editar Contratada',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao8 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratadas.destroy',
            'ds_operacao'=> 'Excluir Contratada',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao9 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratantes.index',
            'ds_operacao'=> 'Contratante',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao10 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratantes.store',
            'ds_operacao'=> 'Adicionar Contratante',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao11 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratantes.edit',
            'ds_operacao'=> 'Editar Contratante',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao12 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratantes.destroy',
            'ds_operacao'=> 'Excluir Contratante',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao13 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratos.index',
            'ds_operacao'=> 'Contrato',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao14 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratos.store',
            'ds_operacao'=> 'Adicionar Contrato',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao15 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratos.edit',
            'ds_operacao'=> 'Editar Contrato',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao16 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::contratos.destroy',
            'ds_operacao'=> 'Excluir Contrato',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao17 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::fiscais.index',
            'ds_operacao'=> 'Fiscal',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao18 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::fiscais.store',
            'ds_operacao'=> 'Adicionar Fiscal',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao19 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::fiscais.edit',
            'ds_operacao'=> 'Editar Fiscal',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao20 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::fiscais.destroy',
            'ds_operacao'=> 'Excluir Fiscal',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao21 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_itens_contratacao.index',
            'ds_operacao'=> 'Tipo Item Contratação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao22 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_itens_contratacao.store',
            'ds_operacao'=> 'Adicionar Tipo Item Contratação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao23 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_itens_contratacao.edit',
            'ds_operacao'=> 'Editar Tipo Item Contratação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao24 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_itens_contratacao.destroy',
            'ds_operacao'=> 'Excluir Tipo Item Contratação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao25 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::unidades_medida_item_contratacao.index',
            'ds_operacao'=> 'Unidade de Medida',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao26 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::unidades_medida_item_contratacao.store',
            'ds_operacao'=> 'Adicionar Unidade de Medida',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao27 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::unidades_medida_item_contratacao.edit',
            'ds_operacao'=> 'Editar Unidade de Medida',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao28 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::unidades_medida_item_contratacao.destroy',
            'ds_operacao'=> 'Excluir Unidade de Medida',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao29 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::relatorios.comparativo_contrato',
            'ds_operacao'=> 'Comparativo',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao30 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::relatorios.geral_contrato',
            'ds_operacao'=> 'Geral',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao31 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::dados_administracao.index',
            'ds_operacao'=> 'Dados de Administração',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);        

        $operacao32 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::cadastros.index',
            'ds_operacao'=> 'Cadastros',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);        



        //ITEM MENU
        $menu1 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Dados de Administração',
            'rota' => self::SISTEMA_MODULO.'::inicio',
            'ordem' => '20',
            'icon' => 'menu-icon glyphicon glyphicon-list-alt',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao31->id_operacao          
        ]);

        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Modalidade',
           'rota' => self::SISTEMA_MODULO.'::modalidades.index',
           'ordem' => '205',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao1->id_operacao,
           'id_item_menu_precedente' => $menu1->id_item_menu
        ]);


        $menu3 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Cadastros',
            'rota' => self::SISTEMA_MODULO.'::inicio',
            'ordem' => '10',
            'icon' => 'menu-icon fa fa-database',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao32->id_operacao          
        ]);

        $menu4 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Contratada',
           'rota' => self::SISTEMA_MODULO.'::contratadas.index',
           'ordem' => '125',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao5->id_operacao,
           'id_item_menu_precedente' => $menu3->id_item_menu
        ]);

        $menu5 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Contratante',
           'rota' => self::SISTEMA_MODULO.'::contratantes.index',
           'ordem' => '115',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao9->id_operacao,
           'id_item_menu_precedente' => $menu3->id_item_menu
        ]);

        $menu6 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Contrato',
           'rota' => self::SISTEMA_MODULO.'::contratos.index',
           'ordem' => '105',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao13->id_operacao,
           'id_item_menu_precedente' => $menu3->id_item_menu
        ]);

        $menu7 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Fiscal',
           'rota' => self::SISTEMA_MODULO.'::fiscais.index',
           'ordem' => '135',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao17->id_operacao,
           'id_item_menu_precedente' => $menu3->id_item_menu
        ]);

        $menu8 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Objeto de Contratação',
           'rota' => self::SISTEMA_MODULO.'::tipos_itens_contratacao.index',
           'ordem' => '215',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao21->id_operacao,
           'id_item_menu_precedente' => $menu1->id_item_menu
        ]);

        $menu9 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Unidade de Medida',
           'rota' => self::SISTEMA_MODULO.'::unidades_medida_item_contratacao.index',
           'ordem' => '225',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao25->id_operacao,
           'id_item_menu_precedente' => $menu1->id_item_menu
        ]);

        $menu10 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Relatórios',
            'rota' => self::SISTEMA_MODULO.'::inicio',
            'ordem' => '30',
            'icon' => 'menu-icon glyphicon glyphicon-stats',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao0->id_operacao          
        ]);

        $menu11 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Geral',
            'rota' => self::SISTEMA_MODULO.'::relatorios.geral_contrato',
            'ordem' => '305',
            'tipo' => 'submenu',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao30->id_operacao,
           'id_item_menu_precedente' => $menu10->id_item_menu
        ]);

        $menu12 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Comparativo',
            'rota' => self::SISTEMA_MODULO.'::relatorios.comparativo_contrato',
            'ordem' => '315',
            'tipo' => 'submenu',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao29->id_operacao,
           'id_item_menu_precedente' => $menu10->id_item_menu
        ]);


        //ATRIBUICAO DE OPERACAO PARA PEFIL
        //PERFIL 1
        $perfil1->addOperacoes($operacao0);
        $perfil1->addOperacoes($operacao1);
        $perfil1->addOperacoes($operacao2);
        $perfil1->addOperacoes($operacao3);
        $perfil1->addOperacoes($operacao4);
        $perfil1->addOperacoes($operacao5);
        $perfil1->addOperacoes($operacao6);
        $perfil1->addOperacoes($operacao7);
        $perfil1->addOperacoes($operacao8);
        $perfil1->addOperacoes($operacao9);
        $perfil1->addOperacoes($operacao10);
        $perfil1->addOperacoes($operacao11);
        $perfil1->addOperacoes($operacao12);
        $perfil1->addOperacoes($operacao13);
        $perfil1->addOperacoes($operacao14);
        $perfil1->addOperacoes($operacao15);
        $perfil1->addOperacoes($operacao16);
        $perfil1->addOperacoes($operacao17);
        $perfil1->addOperacoes($operacao18);
        $perfil1->addOperacoes($operacao19);
        $perfil1->addOperacoes($operacao20);
        $perfil1->addOperacoes($operacao21);
        $perfil1->addOperacoes($operacao22);
        $perfil1->addOperacoes($operacao23);
        $perfil1->addOperacoes($operacao24);
        $perfil1->addOperacoes($operacao25);
        $perfil1->addOperacoes($operacao26);
        $perfil1->addOperacoes($operacao27);
        $perfil1->addOperacoes($operacao28);
        $perfil1->addOperacoes($operacao29);
        $perfil1->addOperacoes($operacao30);
        
        //PERFIL 2
        $perfil2->addOperacoes($operacao0);
        $perfil2->addOperacoes($operacao5);
        $perfil2->addOperacoes($operacao6);
        $perfil2->addOperacoes($operacao7);
        $perfil2->addOperacoes($operacao8);
        $perfil2->addOperacoes($operacao13);
        $perfil2->addOperacoes($operacao14);
        $perfil2->addOperacoes($operacao15);
        $perfil2->addOperacoes($operacao16);
        $perfil2->addOperacoes($operacao17);
        $perfil2->addOperacoes($operacao18);
        $perfil2->addOperacoes($operacao19);
        $perfil2->addOperacoes($operacao20);
        $perfil2->addOperacoes($operacao29);
        $perfil2->addOperacoes($operacao30);

        //PERFIL 3
        $perfil3->addOperacoes($operacao0);
        $perfil3->addOperacoes($operacao29);
        $perfil3->addOperacoes($operacao30);
        
        //ATRIBUICAO DE PERFIL ADMINISTRADOR PARA USUARIOS 1,2,3
        $user1 = User::find(1);
        $user1->addPerfil($perfil1);

        $user2 =User::find(2);
        $user2->addPerfil($perfil1);

        $user3 =User::find(3);        
        $user3->addPerfil($perfil1);

        $user4 =User::find(4);        
        $user4->addPerfil($perfil1);        
    }
}
