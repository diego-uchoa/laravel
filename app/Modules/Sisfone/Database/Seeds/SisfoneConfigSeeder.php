<?php

namespace App\Modules\Sisfone\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Sisadm\Models\User;

class SisfoneConfigSeeder extends Seeder
{
    
    //CONSTANTES DO SISTEMA
    const SISTEMA = 'SISFONE';
    const SISTEMA_DESCRICAO = 'Sistema de Catálogo Telefônico';
    const SISTEMA_MODULO = 'sisfone';

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
            'tx_beneficio' => 'Sistema responsável por gerenciar os ramais telefônicos da SPOA',
            'tx_publico' => 'Servidores do Ministério da Fazenda',
            'co_esquema' => 'spoa_portal_sisfone',
            'sn_ativo' => true,
            'sn_tela_inicial' => true,
            'no_responsavel' => 'André Veras',
            'tx_email_responsavel' => 'andre.veras@fazenda.gov.br',
            'id_area' => 3,
            'nr_ordem' => 4
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
            'ds_operacao' => 'Início',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::telefone.index',
            'ds_operacao' => 'Lista Telefone',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::telefone.create',
            'ds_operacao' => 'Criar Telefone',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::telefone.store',
            'ds_operacao' => 'Salvar Telefone',  
            'id_sistema' => $sistema->id_sistema,          
        ]);

        $operacao4 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::telefone.edit',
            'ds_operacao' => 'Editar Telefone', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao5 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::telefone.update',
            'ds_operacao' => 'Atualizar Telefone',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao6 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::telefone.destroy',
            'ds_operacao' => 'Deletar Telefone',  
            'id_sistema' => $sistema->id_sistema,          
        ]);
       
        //ITEM MENU (ADMINISTRADOR)
        $menu1 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Telefone',
            'rota' => self::SISTEMA_MODULO.'::inicio',
            'ordem' => '2',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao0->id_operacao          
        ]); 
        
        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Lista Telefone',
            'rota' => self::SISTEMA_MODULO.'::telefone.index',
            'ordem' => '40',
            'tipo' => 'submenu',
            'id_sistema' => $sistema->id_sistema,
            'id_item_menu_precedente' => $menu1->id_item_menu,
            'id_operacao' => $operacao1->id_operacao     
        ]);

        //ITEM MENU (USUARIO)
        //FALTA 

        //ATRIBUICAO DE OPERACAO PARA PEFIL
        //GESTOR
        $perfil1->addOperacoes($operacao0);
        $perfil1->addOperacoes($operacao1);
        $perfil1->addOperacoes($operacao2);
        $perfil1->addOperacoes($operacao3);
        $perfil1->addOperacoes($operacao4);
        $perfil1->addOperacoes($operacao5);
        $perfil1->addOperacoes($operacao6);

        //USUARIO
        $perfil2->addOperacoes($operacao0);
        $perfil2->addOperacoes($operacao1);
        $perfil2->addOperacoes($operacao2);
        $perfil2->addOperacoes($operacao3);
        $perfil2->addOperacoes($operacao4);
        $perfil2->addOperacoes($operacao5);
        $perfil2->addOperacoes($operacao6);

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
