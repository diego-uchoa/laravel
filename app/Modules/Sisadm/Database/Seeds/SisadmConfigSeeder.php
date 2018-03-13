<?php

namespace App\Modules\Sisadm\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Sisadm\Models\User;

class SisadmConfigSeeder extends Seeder
{
    
    //CONSTANTES DO SISTEMA
    const SISTEMA = 'SISADM';
    const SISTEMA_DESCRICAO = 'Sistema de Administração';
    const SISTEMA_MODULO = 'sisadm';

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

        //ESPECIFICO
        \App\Modules\Sisadm\Models\AvisoSistema::where('id_sistema',$sistemaAnterior->id_sistema)->delete();

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
            'tx_beneficio' => 'Sistema responsável por gerenciar os demais sistemas do Portal',
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
            'no_perfil' => self::SISTEMA.'-Administrador',
            'ds_perfil' => self::SISTEMA.'-Administrador do Sistema',
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
              
        //USUÁRIOS
        $operacao1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.index',
            'ds_operacao' => 'Listar Usuários',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.create',
            'ds_operacao' => 'Criar Usuários',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.store',
            'ds_operacao' => 'Salvar Usuários',
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao4 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.edit',
            'ds_operacao' => 'Editar Usuários',
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao5 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.update',
            'ds_operacao' => 'Atualizar Usuários',
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao6 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.destroy',
            'ds_operacao' => 'Deletar Usuários',
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao7 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.perfis',
            'ds_operacao' => 'Listar Pefis Usuários',
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao8 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.perfis.store',
            'ds_operacao' => 'Salvar Perfis Usuários',
            'id_sistema' => $sistema->id_sistema,     
        ]);

        $operacao9 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.perfis.revoke',
            'ds_operacao' => 'Deletar Perfis Usuários',
            'id_sistema' => $sistema->id_sistema,  
        ]);

        //PERFIS
        $operacao10 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.index',
            'ds_operacao' => 'Listar Perfis',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao11 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.create',
            'ds_operacao' => 'Criar Perfis',      
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao12 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.store',
            'ds_operacao' => 'Salvar Perfis',
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao13 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.edit',
            'ds_operacao' => 'Editar Perfis',   
            'id_sistema' => $sistema->id_sistema,   
        ]);

        $operacao14 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.update',
            'ds_operacao' => 'Atualizar Perfis',
            'id_sistema' => $sistema->id_sistema,      
        ]);

        $operacao15 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.destroy',
            'ds_operacao' => 'Deletar Perfis',  
            'id_sistema' => $sistema->id_sistema,    
        ]);

        $operacao15_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.operacoes',
            'ds_operacao' => 'Listar Operações Perfis',      
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao16 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.operacoes.store',
            'ds_operacao' => 'Deletar Operações Perfis',      
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao17 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.operacoes.revoke',
            'ds_operacao' => 'Deletar Operações Perfis',  
            'id_sistema' => $sistema->id_sistema,    
        ]);

        $operacao18 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfis.itens',
            'ds_operacao' => 'Listar Itens Perfis',  
            'id_sistema' => $sistema->id_sistema,    
        ]);

        //SISTEMAS
        $operacao19 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::sistemas.index',
            'ds_operacao' => 'Listar Sistemas',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao20 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::sistemas.create',
            'ds_operacao' => 'Criar Sistemas',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao21 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::sistemas.store',
            'ds_operacao' => 'Salvar Sistemas', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao22 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::sistemas.edit',
            'ds_operacao' => 'Editar Sistemas', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao23 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::sistemas.update',
            'ds_operacao' => 'Atualizar Sistemas', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao24 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::sistemas.destroy',
            'ds_operacao' => 'Deletar Sistemas',
            'id_sistema' => $sistema->id_sistema,            
        ]);

       
        //ITEM MENU

        $operacao25 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::itens_menu.index',
            'ds_operacao' => 'Listar Itens de Menu',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao26 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::itens_menu.create',
            'ds_operacao' => 'Criar Itens de Menu',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao27 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::itens_menu.store',
            'ds_operacao' => 'Salvar Itens de Menu',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao28 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::itens_menu.edit',
            'ds_operacao' => 'Editar Itens de Menu', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao29 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::itens_menu.update',
            'ds_operacao' => 'Atualizar Itens de Menu', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao30 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::itens_menu.destroy',
            'ds_operacao' => 'Deletar Itens de Menu',   
            'id_sistema' => $sistema->id_sistema,         
        ]);

        //OPERACOES

        $operacao31 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacoes.index',
            'ds_operacao' => 'Listar Operação',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao32 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacoes.create',
            'ds_operacao' => 'Criar Operação',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao33 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacoes.store',
            'ds_operacao' => 'Salvar Operação', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao34 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacoes.edit',
            'ds_operacao' => 'Editar Operação', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao35 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacoes.update',
            'ds_operacao' => 'Atualizar Operação',            
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao36 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacoes.destroy',
            'ds_operacao' => 'Deletar Operação',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        //AVISO SISTEMA

        $operacao37 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_sistema.index',
            'ds_operacao' => 'Listar Aviso Sistema',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao38 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_sistema.create',
            'ds_operacao' => 'Criar Aviso Sistema',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao39 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_sistema.store',
            'ds_operacao' => 'Salvar Aviso Sistema', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao40 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_sistema.edit',
            'ds_operacao' => 'Editar Aviso Sistema', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao41 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_sistema.update',
            'ds_operacao' => 'Atualizar Aviso Sistema',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao42 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_sistema.destroy',
            'ds_operacao' => 'Deletar Aviso Sistema', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        //AVISO USUÁRIO

        $operacao43 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_usuario.index',
            'ds_operacao' => 'Listar Aviso Usuário',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao44 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_usuario.create',
            'ds_operacao' => 'Criar Aviso Usuário',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao45 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_usuario.store',
            'ds_operacao' => 'Salvar Aviso Usuário', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao46 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_usuario.edit',
            'ds_operacao' => 'Editar Aviso Usuário',
            'id_sistema' => $sistema->id_sistema,          
        ]);

        $operacao47 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_usuario.update',
            'ds_operacao' => 'Atualizar Aviso Usuário',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao48 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_usuario.destroy',
            'ds_operacao' => 'Deletar Aviso Usuário',
            'id_sistema' => $sistema->id_sistema,          
        ]);

        //AVISO GERAL

        $operacao49 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_geral.index',
            'ds_operacao' => 'Aviso Geral',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao49_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::aviso_geral.indexGeral',
            'ds_operacao' => 'Aviso Geral - Portal',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        //FERIADO

        $operacao50 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::feriado.index',
            'ds_operacao' => 'Listar Feriado',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao51 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::feriado.create',
            'ds_operacao' => 'Criar Feriado',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao52 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::feriado.store',
            'ds_operacao' => 'Salvar Feriado', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao53 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::feriado.edit',
            'ds_operacao' => 'Editar Feriado',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao54 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::feriado.update',
            'ds_operacao' => 'Atualizar Feriado',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao55 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::feriado.destroy',
            'ds_operacao' => 'Deletar Feriado',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        //INCOSISTENCIA

        $operacao55_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::inconsistencia.index',
            'ds_operacao' => 'Listar Inconsistências',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao55_2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::inconsistencia.verifica',
            'ds_operacao' => 'Verificar Inconsistências',            
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao55_3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::inconsistencia.limpa',
            'ds_operacao' => 'Limpar Inconsistências',            
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao55_4 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::inconsistencia.destroy',
            'ds_operacao' => 'Deletar Inconsistências',           
            'id_sistema' => $sistema->id_sistema,
        ]);



        //OPERACAO FAVORITA 

        $operacao56 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacao_favorita.index',
            'ds_operacao' => 'Listar Operação Favorita',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao57 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::operacao_favorita.store',
            'ds_operacao' => 'Salvar Operação Favorita', 
            'id_sistema' => $sistema->id_sistema,                       
        ]);

        //LOG

        $operacao58 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> 'log-viewer::dashboard',
            'ds_operacao' => 'Painel de Logs',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao59 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> 'log-viewer::logs.list',
            'ds_operacao' => 'Lista de Logs',                        
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

       
        //EVENTO
        $operacao60 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::evento.index',
            'ds_operacao' => 'Listar Evento',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao61 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::evento.create',
            'ds_operacao' => 'Criar Evento',            
            'sn_favorita' => true,
            'id_sistema' => $sistema->id_sistema,
        ]);

        $operacao62 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::evento.store',
            'ds_operacao' => 'Salvar Evento', 
            'id_sistema' => $sistema->id_sistema,           
        ]);

        $operacao63 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::evento.edit',
            'ds_operacao' => 'Editar Evento',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao64 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::evento.update',
            'ds_operacao' => 'Atualizar Evento',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        $operacao65 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::evento.destroy',
            'ds_operacao' => 'Deletar Evento',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        //AUDITORIA
        $operacao66 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::auditoria.search',
            'ds_operacao' => 'Consultar Auditoria',
            'id_sistema' => $sistema->id_sistema,            
        ]);

        //Consulta Usuario DataTable
        $operacao67 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.records',
            'ds_operacao' => 'Consultar Usuários Cadastrados no sistema',
            'id_sistema' => $sistema->id_sistema,            
        ]);


        /***********************************************************************************************
        /*  MENU
        /*
        /***********************************************************************************************/       

        //MENU
        $menu1 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Tabelas Usuários',
           'rota' => 'sisadm::inicio',
           'ordem' => '10',
           'icon' => 'menu-icon glyphicon glyphicon-user',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao0->id_operacao
        ]);

        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Usuários',
           'rota' => 'sisadm::usuarios.index',
           'ordem' => '101',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,   
           'id_operacao' => $operacao1->id_operacao,  
           'id_item_menu_precedente' => $menu1->id_item_menu
        ]); 

        $menu3 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Perfis',
           'rota' => 'sisadm::perfis.index',
           'ordem' => '102',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema, 
           'id_operacao' => $operacao10->id_operacao,
           'id_item_menu_precedente' =>  $menu1->id_item_menu
        ]); 

        //TABELAS PORTAIS
        $menu4 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Tabelas Portal',
           'rota' => 'sisadm::inicio',
           'ordem' => '20',
           'icon' => 'menu-icon glyphicon glyphicon-list-alt',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema, 
           'id_operacao' => $operacao0->id_operacao          
        ]); 

        $menu5 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Sistemas',
           'rota' => 'sisadm::sistemas.index',
           'ordem' => '204',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao19->id_operacao,
           'id_item_menu_precedente' => $menu4->id_item_menu
        ]);

        $menu6 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Operações',
           'rota' => 'sisadm::operacoes.index',
           'ordem' => '203',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,  
           'id_operacao' => $operacao31->id_operacao,         
           'id_item_menu_precedente' => $menu4->id_item_menu
        ]);

        $menu8 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Itens de Menu',
           'rota' => 'sisadm::itens_menu.index',
           'ordem' => '201',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,     
           'id_operacao' => $operacao25->id_operacao,      
           'id_item_menu_precedente' => $menu4->id_item_menu
        ]);

        //TABELAS AVISOS
        $menu9 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Tabelas Avisos',
           'rota' => 'sisadm::inicio',
           'ordem' => '30',
           'icon' => 'menu-icon glyphicon glyphicon-warning-sign',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao0->id_operacao
        ]); 

        $menu10 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Aviso Sistema',
           'rota' => 'sisadm::aviso_sistema.index',
           'ordem' => '31',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao37->id_operacao,
           'id_item_menu_precedente' => $menu9->id_item_menu
        ]);

        $menu11 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Aviso Usuário',
           'rota' => 'sisadm::aviso_usuario.index',
           'ordem' => '32',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao43->id_operacao,
           'id_item_menu_precedente' => $menu9->id_item_menu
        ]);


        //TABELAS AUXILIARES
        $menu12 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Tabelas Auxiliares',
           'rota' => 'sisadm::inicio',
           'ordem' => '30',
           'icon' => 'menu-icon glyphicon glyphicon-list-alt',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao0->id_operacao
        ]); 

        $menu13 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Feriado',
           'rota' => 'sisadm::feriado.index',
           'ordem' => '31',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao50->id_operacao,
           'id_item_menu_precedente' => $menu12->id_item_menu
        ]);

        $menu12_2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Inconsistência',
           'rota' => 'sisadm::inconsistencia.index',
           'ordem' => '31',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao55_1->id_operacao,
           'id_item_menu_precedente' => $menu12->id_item_menu
        ]);

        //VISUALIZADOR LOG
        $menu14 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Visualizador de Log',
           'rota' => 'sisadm::inicio',
           'ordem' => '99',
           'icon' => 'menu-icon glyphicon glyphicon-flag',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao0->id_operacao
        ]);

        $menu15 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Painel de Controle',
           'rota' => 'log-viewer::dashboard',
           'ordem' => '1',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao58->id_operacao,
           'id_item_menu_precedente' => $menu14->id_item_menu
        ]);

        $menu16 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Logs',
           'rota' => 'log-viewer::logs.list',
           'ordem' => '2',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao59->id_operacao,
           'id_item_menu_precedente' => $menu14->id_item_menu
        ]);

        //FAVORITOS
        $menu17 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Favoritos',
           'rota' => 'sisadm::inicio',
           'ordem' => '99',
           'icon' => 'menu-icon glyphicon glyphicon-star',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao0->id_operacao
        ]);

        $menu18 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Operações Favoritas',
           'rota' => 'sisadm::operacao_favorita.index',
           'ordem' => '2',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao56->id_operacao,
           'id_item_menu_precedente' => $menu17->id_item_menu
        ]);

        //EVENTOS
        $menu19 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Eventos',
           'rota' => 'sisadm::inicio',
           'ordem' => '99',
           'icon' => 'menu-icon glyphicon glyphicon-calendar',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao0->id_operacao
        ]);

        $menu20 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Eventos',
           'rota' => 'sisadm::evento.index',
           'ordem' => '2',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao60->id_operacao,
           'id_item_menu_precedente' => $menu19->id_item_menu
        ]);

        //AUDITORIA

        $menu21 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Auditoria',
           'rota' => 'sisadm::inicio',
           'ordem' => '99',
           'icon' => 'menu-icon glyphicon glyphicon-briefcase',
           'tipo' => 'raiz',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao0->id_operacao
        ]);

        $menu22 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Consultar Auditoria',
           'rota' => 'sisadm::auditoria.search',
           'ordem' => '2',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,
           'id_operacao' => $operacao66->id_operacao,
           'id_item_menu_precedente' => $menu21->id_item_menu
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
        $perfil1->addOperacoes($operacao15_1);        
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
        $perfil1->addOperacoes($operacao31);
        $perfil1->addOperacoes($operacao32);
        $perfil1->addOperacoes($operacao33);
        $perfil1->addOperacoes($operacao34);
        $perfil1->addOperacoes($operacao35);
        $perfil1->addOperacoes($operacao36);
        $perfil1->addOperacoes($operacao37);
        $perfil1->addOperacoes($operacao38);
        $perfil1->addOperacoes($operacao39);
        $perfil1->addOperacoes($operacao40);
        $perfil1->addOperacoes($operacao41);
        $perfil1->addOperacoes($operacao42);
        $perfil1->addOperacoes($operacao43);
        $perfil1->addOperacoes($operacao44);
        $perfil1->addOperacoes($operacao45);
        $perfil1->addOperacoes($operacao46);
        $perfil1->addOperacoes($operacao47);
        $perfil1->addOperacoes($operacao48);
        $perfil1->addOperacoes($operacao49);
        $perfil1->addOperacoes($operacao49_1);
        $perfil1->addOperacoes($operacao50);
        $perfil1->addOperacoes($operacao51);
        $perfil1->addOperacoes($operacao52);
        $perfil1->addOperacoes($operacao53);
        $perfil1->addOperacoes($operacao54);
        $perfil1->addOperacoes($operacao55);
        $perfil1->addOperacoes($operacao55_1);
        $perfil1->addOperacoes($operacao55_2);
        $perfil1->addOperacoes($operacao55_3);
        $perfil1->addOperacoes($operacao55_4);
        $perfil1->addOperacoes($operacao56);
        $perfil1->addOperacoes($operacao57);
        $perfil1->addOperacoes($operacao58);
        $perfil1->addOperacoes($operacao59);
        $perfil1->addOperacoes($operacao60);
        $perfil1->addOperacoes($operacao61);
        $perfil1->addOperacoes($operacao62);
        $perfil1->addOperacoes($operacao63);
        $perfil1->addOperacoes($operacao64);
        $perfil1->addOperacoes($operacao65);
        $perfil1->addOperacoes($operacao66);
        $perfil1->addOperacoes($operacao67);
        
        //USUARIO
        $perfil2->addOperacoes($operacao0);
        $perfil2->addOperacoes($operacao1);
        $perfil2->addOperacoes($operacao2);
        $perfil2->addOperacoes($operacao3);
        $perfil2->addOperacoes($operacao4);
        $perfil2->addOperacoes($operacao5);
        $perfil2->addOperacoes($operacao6);


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


        $user12 =User::find(12);        
        $user12->addPerfil($perfil1);
        
    }
}
