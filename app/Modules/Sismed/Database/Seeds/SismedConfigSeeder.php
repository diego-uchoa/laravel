<?php

namespace App\Modules\Sismed\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Sisadm\Models\User;
use App\Modules\Sisadm\Models\Sistema;

class SismedConfigSeeder extends Seeder
{
    
    //CONSTANTES DO SISTEMA
    const SISTEMA = 'SISMED';
    const SISTEMA_DESCRICAO = 'Sistema do Serviço Médico';
    const SISTEMA_MODULO = 'sismed';

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
            'tx_beneficio' => 'Sistema responsável por gerenciar os atestados apresentados pelos servidores do Ministério da Fazenda ',
            'tx_publico' => 'Servidores do Ministério da Fazenda',
            'co_esquema' => 'spoa',
            'sn_ativo' => true,
            'sn_tela_inicial' => true,
            'no_responsavel' => 'André Veras, André Boaro, Alan Melo',
            'tx_email_responsavel' => 'andre.veras@fazenda.gov.br, andre.boaro@fazenda.gov.br, alan.melo@fazenda.gov.br',
            'id_area' => 3,
            'nr_ordem' => 1
        ]);

        /***********************************************************************************************
        /*  PERFIL
        /*
        /***********************************************************************************************/
        $perfil1 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Gestor',
            'ds_perfil' => self::SISTEMA.'-Gestor do Sistema',
            'id_sistema' => $sistema->id_sistema,
        ]);


        $perfil2 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Usuario',
            'ds_perfil' => self::SISTEMA.'-Usuário do Sistema',
            'id_sistema' => $sistema->id_sistema,
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

        //SERVIDOR
        $operacao1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.index',
            'ds_operacao' => 'Listar Servidores',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.create',
            'ds_operacao' => 'Criar Servidores',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.store',
            'ds_operacao' => 'Salvar Servidores',
            'sn_favorita' => false,
            'id_sistema' => $sistema->id_sistema,            
        ]);
        
        $operacao4 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.edit',
            'ds_operacao' => 'Editar Servidores',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao5 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.update',
            'ds_operacao' => 'Atualizar Servidores',
            'sn_favorita' => false,
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao6 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.destroy',
            'ds_operacao' => 'Deletar Servidores',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao7 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.atestados',
            'ds_operacao' => 'Atestados Servidores',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao8 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.consulta',
            'ds_operacao' => 'Consulta Servidores cadastrados no sistema',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao9 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::servidor.consultaws',
            'ds_operacao' => 'Consulta Dados Servidores no WS Siape',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);


        //ATESTADO
        $operacao10 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.index',
            'ds_operacao' => 'Listar Atestados',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao11 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.create',
            'ds_operacao' => 'Criar Atestados',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao12 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.store',
            'ds_operacao' => 'Salvar Atestados',      
            'sn_favorita' => false,
            'id_sistema' => $sistema->id_sistema,
        ]);
        
        $operacao13 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.edit',
            'ds_operacao' => 'Editar Atestados',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao14 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.update',
            'ds_operacao' => 'Atualizar Atestados',
            'sn_favorita' => false,
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao15 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.destroy',
            'ds_operacao' => 'Deletar Atestados',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao16 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.upload',
            'ds_operacao' => 'Upload Atestados',
            'sn_favorita' => false,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao17 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.show',
            'ds_operacao' => 'Show Atestados',
            'sn_favorita' => false,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao18 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.uploadFile',
            'ds_operacao' => 'Upload Laudos',
            'sn_favorita' => false,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao19 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestados',
            'ds_operacao' => 'Atestados',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao20 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::relatorio_atestados',
            'ds_operacao' => 'Relatório de Estatísticas Atestados',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao21 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::atestado.cancelar',
            'ds_operacao' => 'Cancelar Atestados',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        /***********************************************************************************************
        /*  MENU
        /*
        /***********************************************************************************************/       

        //MENU
        $menu1 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Servidor',
           'rota' => 'sismed::servidor.index',
           'ordem' => '10',
           'icon' => 'menu-icon ace-icon fa fa-user',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao1->id_operacao
        ]);

        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Atestados',
           'rota' => 'sismed::atestado.index',
           'ordem' => '20',
           'icon' => 'menu-icon ace-icon fa fa-search-plus',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,   
           'id_operacao' => $operacao10->id_operacao,  
        ]);

        $menu3 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Meus Atestados',
           'rota' => 'sismed::atestado.show',
           'ordem' => '30',
           'icon' => 'menu-icon ace-icon fa fa-plus-square',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,   
           'id_operacao' => $operacao10->id_operacao,  
        ]);

        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Relatórios',
           'rota' => 'sismed::relatorio.index',
           'ordem' => '40',
           'icon' => 'menu-icon ace-icon fa fa-file-pdf-o',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,   
           'id_operacao' => $operacao10->id_operacao,  
        ]);


        /***********************************************************************************************
        /*  ATRIBUICAO DE OPERACAO PARA PEFIL
        /*
        /***********************************************************************************************/ 
        
        //GESTOR
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

        
        /***********************************************************************************************
        /*  ATRIBUICAO DE PERFIL ADMINISTRADOR PARA USUARIOS 1,2,3,4
        /*
        /***********************************************************************************************/ 
        
        $user1 = User::find(1);
        $user1->addPerfil($perfil1);

        $user2 =User::find(2);
        $user2->addPerfil($perfil1);

        $user3 =User::find(3);        
        $user3->addPerfil($perfil1);        

        $user4 =User::find(4);        
        $user4->addPerfil($perfil1);


        /***********************************************************************************************
        /*  ATRIBUICAO DE PERFIL GESTOR PARA USUARIOS 5,6,7,8,9,10,11 (USUÁRIOS DO SERVIÇO DE SAÚDE)
        /*
        /***********************************************************************************************/ 

        $user5 =User::find(5);        
        $user5->addPerfil($perfil1);

        $user6 =User::find(6);        
        $user6->addPerfil($perfil1);

        $user7 =User::find(7);        
        $user7->addPerfil($perfil1);

        $user8 =User::find(8);        
        $user8->addPerfil($perfil1);

        $user9 =User::find(9);        
        $user9->addPerfil($perfil1);

        $user10 =User::find(10);        
        $user10->addPerfil($perfil1);

        $user11 =User::find(11);        
        $user11->addPerfil($perfil1);

        $user12 =User::find(12);        
        $user12->addPerfil($perfil1);
        
    }
}
