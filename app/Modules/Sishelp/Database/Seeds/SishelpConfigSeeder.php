<?php

namespace App\Modules\Sishelp\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Sisadm\Models\User;

class SishelpConfigSeeder extends Seeder
{
    
    //CONSTANTES DO SISTEMA
    const SISTEMA = 'SISHELP';
    const SISTEMA_DESCRICAO = 'Sistema de Ajuda';
    const SISTEMA_MODULO = 'sishelp';

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
            'tx_beneficio' => 'Sistema responsável por gerenciar a ajuda para os sistemas do Portal',
            'tx_publico' => 'Servidores do Ministério da Fazenda',
            'co_esquema' => 'spoa_portal_sishelp',
            'sn_ativo' => true,
            'sn_tela_inicial' => true,
            'no_responsavel' => 'André Veras, André Boaro, Alan Melo',
            'tx_email_responsavel' => 'andre.veras@fazenda.gov.br, andre.boaro@fazenda.gov.br, alan.melo@fazenda.gov.br',
            'id_area' => 3,
            'nr_ordem' => 4
        ]);      

        /***********************************************************************************************
        /*  PERFIL
        /*
        /***********************************************************************************************/
        $perfil1 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Administrador',
            'ds_perfil' => self::SISTEMA.'-Administrador do Sistema',
            'id_sistema' => $sistema->id_sistema
        ]);

        
        $perfil2 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Usuario',
            'ds_perfil' => self::SISTEMA.'-Usuário do Sistema',
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

        //AJUDA FAQ
        $operacao10 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_faq.index',
            'ds_operacao' => 'Lista Ajuda Faq',            
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao11 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_faq.create',
            'ds_operacao' => 'Criar Ajuda Faq',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao12 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_faq.store',
            'ds_operacao' => 'Salvar Ajuda Faq',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao13 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_faq.edit',
            'ds_operacao' => 'Editar Ajuda Faq',
            'id_sistema' => $sistema->id_sistema,          
        ]);

        $operacao14 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_faq.update',
            'ds_operacao' => 'Atualizar Ajuda Faq',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao15 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_faq.destroy',
            'ds_operacao' => 'Deletar Ajuda Faq',
            'id_sistema' => $sistema->id_sistema,           
        ]);

        //AJUDA ARQUIVO
        $operacao20 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_arquivo.index',
            'ds_operacao' => 'Lista Ajuda Arquivo',            
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,
        ]);
       
        $operacao21 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_arquivo.create',
            'ds_operacao' => 'Criar Ajuda Arquivo',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao22 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_arquivo.store',
            'ds_operacao' => 'Salvar Ajuda Arquivo',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao23 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_arquivo.edit',
            'ds_operacao' => 'Editar Ajuda Arquivo',
            'id_sistema' => $sistema->id_sistema,          
        ]);

        $operacao24 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_arquivo.update',
            'ds_operacao' => 'Atualizar Ajuda Arquivo',
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao25 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_arquivo.destroy',
            'ds_operacao' => 'Deletar Ajuda Arquivo',
            'id_sistema' => $sistema->id_sistema,            
        ]);


        //AJUDA GERAL
        $operacao30 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_geral.index',
            'ds_operacao' => 'Lista Ajuda Geral',            
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao31 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_geral.create',
            'ds_operacao' => 'Criar Ajuda Geral',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao32 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_geral.store',
            'ds_operacao' => 'Salvar Ajuda Geral',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao33 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_geral.edit',
            'ds_operacao' => 'Editar Ajuda Geral',
            'id_sistema' => $sistema->id_sistema,          
        ]);

        $operacao34 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_geral.update',
            'ds_operacao' => 'Atualizar Ajuda Geral',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao35 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_geral.destroy',
            'ds_operacao' => 'Deletar Ajuda Geral',
            'id_sistema' => $sistema->id_sistema,           
        ]);

        //AJUDA SISTEMA
        $operacao70 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::ajuda_sistema.index',
            'ds_operacao' => 'Ajuda Sistema',   
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,     
        ]);
        
        //MENU
        $menu1 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Ajuda',
            'rota' => self::SISTEMA_MODULO.'::inicio',
            'ordem' => '2',
            'tipo' => 'raiz',
            'icon' => 'menu-icon glyphicon glyphicon-question-sign',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao0->id_operacao          
        ]); 

        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Visão Geral',
            'rota' => self::SISTEMA_MODULO.'::ajuda_geral.index',
            'ordem' => '10',
            'tipo' => 'submenu',
            'id_sistema' => $sistema->id_sistema,
            'id_item_menu_precedente' => $menu1->id_item_menu,
            'id_operacao' => $operacao30->id_operacao     
        ]);
        
        $menu3 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Perguntas Frequentes',
            'rota' => self::SISTEMA_MODULO.'::ajuda_faq.index',
            'ordem' => '20',
            'tipo' => 'submenu',
            'id_sistema' => $sistema->id_sistema,
            'id_item_menu_precedente' => $menu1->id_item_menu,
            'id_operacao' => $operacao10->id_operacao     
        ]);

        $menu4 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Manuais',
            'rota' => self::SISTEMA_MODULO.'::ajuda_arquivo.index',
            'ordem' => '30',
            'tipo' => 'submenu',
            'id_sistema' => $sistema->id_sistema,
            'id_item_menu_precedente' => $menu1->id_item_menu,
            'id_operacao' => $operacao20->id_operacao     
        ]);

        //ITEM MENU (USUARIO)
        //FALTA 

        //ATRIBUICAO DE OPERACAO PARA PEFIL
        //PERFIL 1
        $perfil1->addOperacoes($operacao0);

        $perfil1->addOperacoes($operacao10);
        $perfil1->addOperacoes($operacao11);
        $perfil1->addOperacoes($operacao12);
        $perfil1->addOperacoes($operacao13);
        $perfil1->addOperacoes($operacao14);
        $perfil1->addOperacoes($operacao15);
        
        $perfil1->addOperacoes($operacao20);
        $perfil1->addOperacoes($operacao21);
        $perfil1->addOperacoes($operacao22);
        $perfil1->addOperacoes($operacao23);
        $perfil1->addOperacoes($operacao24);
        $perfil1->addOperacoes($operacao25);

        $perfil1->addOperacoes($operacao30);
        $perfil1->addOperacoes($operacao31);
        $perfil1->addOperacoes($operacao32);
        $perfil1->addOperacoes($operacao33);
        $perfil1->addOperacoes($operacao34);
        $perfil1->addOperacoes($operacao35);

        //PERFIL 2    
        $perfil2->addOperacoes($operacao70);
        
        //ATRIBUICAO DE PERFIL ADMINISTRADOR PARA USUARIOS 1,2,3,4
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
