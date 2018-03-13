<?php

namespace App\Modules\Parla\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Sisadm\Models\User;

class ParlaConfigSeeder extends Seeder
{
    
    //CONSTANTES DO SISTEMA
    const SISTEMA = 'PARLA';
    const SISTEMA_DESCRICAO = 'Parla';
    const SISTEMA_MODULO = 'parla';

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
            'tx_beneficio' => 'Sistema responsável por gerenciar as proposições legislativas de interesse do Ministério da Fazenda',
            'tx_publico' => 'Servidores do Ministério da Fazenda',
            'co_esquema' => 'spoa_portal_parla',
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
            'no_operacao'=> self::SISTEMA_MODULO.'::parlamentares.index',
            'ds_operacao'=> 'Parlamentares',
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::parlamentares.show',
            'ds_operacao'=> 'Perfil do Parlamentar',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao2_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::parlamentares.edit',
            'ds_operacao'=> 'Editar Parlamentar',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao2_2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::parlamentares.update',
            'ds_operacao'=> 'Atualizar Parlamentar',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.index',
            'ds_operacao'=> 'Proposições',
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao4 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.show',
            'ds_operacao'=> 'Detalhes da proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao5 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.create',
            'ds_operacao'=> 'Adicionar proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao5_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.store',
            'ds_operacao'=> 'Cadastrar proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao6_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.edit.prioritario',
            'ds_operacao'=> 'Editar prioridade da proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao6_2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.edit.observacao',
            'ds_operacao'=> 'Editar observações da proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao6 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.destroy',
            'ds_operacao'=> 'Excluir proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao7 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.update.prioritario',
            'ds_operacao'=> 'Atualizar prioridade da proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao7_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::proposicoes.update.obseervacao',
            'ds_operacao'=> 'Atualizar observações da proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao8 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.index',
            'ds_operacao'=> 'Consultas ao MF',
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao9 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.create',
            'ds_operacao'=> 'Adicionar consulta ao MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao9_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.store',
            'ds_operacao'=> 'Cadastrar consulta ao MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao9_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.edit',
            'ds_operacao'=> 'Editar consulta ao MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao9_2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.update',
            'ds_operacao'=> 'Atualizar consulta ao MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao9_3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.destroy',
            'ds_operacao'=> 'Excluir consulta ao MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao10 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tabelas.index',
            'ds_operacao'=> 'Tabelas',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao11 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposProposicao.index',
            'ds_operacao'=> 'Tipos de Proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao12 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposProposicao.create',
            'ds_operacao'=> 'Adicionar Tipos de Proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao12_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposProposicao.store',
            'ds_operacao'=> 'Cadastrar Tipos de Proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao13 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposProposicao.edit',
            'ds_operacao'=> 'Editar Tipos de Proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao13_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposProposicao.update',
            'ds_operacao'=> 'Atualizar Tipos de Proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao14 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposProposicao.destroy',
            'ds_operacao'=> 'Excluir Tipos de Proposição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao15 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposConsulta.index',
            'ds_operacao'=> 'Tipos de Consulta',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao16 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposConsulta.create',
            'ds_operacao'=> 'Adicionar Tipos de Consulta',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao16_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposConsulta.store',
            'ds_operacao'=> 'Cadastrar Tipos de Consulta',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao17 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposConsulta.edit',
            'ds_operacao'=> 'Editar Tipos de Consulta',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao17_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposConsulta.update',
            'ds_operacao'=> 'Atualizar Tipos de Consulta',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao18 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposConsulta.destroy',
            'ds_operacao'=> 'Excluir Tipos de Consulta',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao19 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposPosicao.index',
            'ds_operacao'=> 'Tipos de Posição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao20 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposPosicao.create',
            'ds_operacao'=> 'Adicionar Tipos de Posição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao20_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposPosicao.store',
            'ds_operacao'=> 'Cadastrar Tipos de Posição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao21 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposPosicao.edit',
            'ds_operacao'=> 'Editar Tipos de Posição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao21_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposPosicao.update',
            'ds_operacao'=> 'Atualizar Tipos de Posição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao22 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tiposPosicao.destroy',
            'ds_operacao'=> 'Excluir Tipos de Posição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao23 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_situacao.index',
            'ds_operacao'=> 'Tipos de Situação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao24 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_situacao.create',
            'ds_operacao'=> 'Adicionar Tipos de Situação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao24_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_situacao.store',
            'ds_operacao'=> 'Cadastrar Tipos de Situação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao25 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_situacao.edit',
            'ds_operacao'=> 'Editar Tipos de Situação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao25_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_situacao.update',
            'ds_operacao'=> 'Atualizar Tipos de Situação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao26 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::tipos_situacao.destroy',
            'ds_operacao'=> 'Excluir Tipos de Situação',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao27 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::respostas_mf.index',
            'ds_operacao'=> 'Respostas do MF',
            'sn_favorita'=> true,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao28 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::respostas_mf.create',
            'ds_operacao'=> 'Editar resposta do MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao28_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::respostas_mf.store',
            'ds_operacao'=> 'Cadastrar resposta do MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao28_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::respostas_mf.edit',
            'ds_operacao'=> 'Editar resposta do MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao28_2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::respostas_mf.update',
            'ds_operacao'=> 'Atualizar resposta do MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao28_3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::respostas_mf.destroy',
            'ds_operacao'=> 'Excluir resposta do MF',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao29 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::comissoes.index',
            'ds_operacao'=> 'Comissões',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao29_0 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::comissoes.show',
            'ds_operacao'=> 'Exibir detalhes das Comissões',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao29_1 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::comissoes.show.edit',
            'ds_operacao'=> 'Editar detalhes das Comissões',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao29_2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::comissoes.show.update',
            'ds_operacao'=> 'Atualizar detalhes das Comissões',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao30 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.relatorio',
            'ds_operacao'=> 'Gerar relatorio',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao31 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::consultasMf.relatorio.generate',
            'ds_operacao'=> 'Exibir relatório',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);


        //ITEM MENU
        $menu1 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Proposições',
            'rota' => self::SISTEMA_MODULO.'::proposicoes.index',
            'ordem' => '1',
            'icon' => 'menu-icon fa fa-files-o',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao3->id_operacao          
        ]);

        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Parlamentares',
            'rota' => self::SISTEMA_MODULO.'::parlamentares.index',
            'ordem' => '2',
            'icon' => 'menu-icon fa fa-users',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao1->id_operacao          
        ]); 

        $menu3 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Consultas ao MF',
            'rota' => self::SISTEMA_MODULO.'::consultasMf.index',
            'ordem' => '3',
            'icon' => 'menu-icon fa fa-question-circle',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao8->id_operacao          
        ]);

        $menu4 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Respostas do MF',
            'rota' => self::SISTEMA_MODULO.'::respostas_mf.index',
            'ordem' => '4',
            'icon' => 'menu-icon fa fa-send',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao27->id_operacao          
        ]);

        $menu5 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Tabelas',
            'rota' => self::SISTEMA_MODULO.'::inicio',
            'ordem' => '6',
            'icon' => 'menu-icon glyphicon glyphicon-list-alt',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao10->id_operacao          
        ]);

        $menu6 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Tipos de Proposição',
           'rota' => self::SISTEMA_MODULO.'::tiposProposicao.index',
           'ordem' => '7',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao11->id_operacao,
           'id_item_menu_precedente' => $menu5->id_item_menu
        ]);

        $menu7 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Tipos de Consulta',
           'rota' => self::SISTEMA_MODULO.'::tiposConsulta.index',
           'ordem' => '8',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao15->id_operacao,
           'id_item_menu_precedente' => $menu5->id_item_menu
        ]);

        $menu8 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Tipos de Posição',
           'rota' => self::SISTEMA_MODULO.'::tiposPosicao.index',
           'ordem' => '9',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao19->id_operacao,
           'id_item_menu_precedente' => $menu5->id_item_menu
        ]);

        $menu9 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
           'no_item_menu' => 'Manter Tipos de Situação',
           'rota' => self::SISTEMA_MODULO.'::tipos_situacao.index',
           'ordem' => '10',
           'tipo' => 'submenu',
           'id_sistema' => $sistema->id_sistema,           
           'id_operacao' => $operacao23->id_operacao,
           'id_item_menu_precedente' => $menu5->id_item_menu
        ]);

        $menu10 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Comissões',
            'rota' => self::SISTEMA_MODULO.'::comissoes.index',
            'ordem' => '5',
            'icon' => 'menu-icon fa fa-gavel',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao29->id_operacao          
        ]);

        //ATRIBUICAO DE OPERACAO PARA PEFIL
        //PERFIL 1
        $perfil1->addOperacoes($operacao0);
        $perfil1->addOperacoes($operacao1);
        $perfil1->addOperacoes($operacao2);
        $perfil1->addOperacoes($operacao2_1);
        $perfil1->addOperacoes($operacao2_2);
        $perfil1->addOperacoes($operacao3);
        $perfil1->addOperacoes($operacao4);
        $perfil1->addOperacoes($operacao5);
        $perfil1->addOperacoes($operacao5_1);
        $perfil1->addOperacoes($operacao6);
        $perfil1->addOperacoes($operacao6_1);
        $perfil1->addOperacoes($operacao6_2);
        $perfil1->addOperacoes($operacao7);
        $perfil1->addOperacoes($operacao7_1);
        $perfil1->addOperacoes($operacao8);
        $perfil1->addOperacoes($operacao9);
        $perfil1->addOperacoes($operacao9_0);
        $perfil1->addOperacoes($operacao9_1);
        $perfil1->addOperacoes($operacao9_2);
        $perfil1->addOperacoes($operacao9_3);
        $perfil1->addOperacoes($operacao10);
        $perfil1->addOperacoes($operacao11);
        $perfil1->addOperacoes($operacao12);
        $perfil1->addOperacoes($operacao12_0);
        $perfil1->addOperacoes($operacao13);
        $perfil1->addOperacoes($operacao13_0);
        $perfil1->addOperacoes($operacao14);
        $perfil1->addOperacoes($operacao15);
        $perfil1->addOperacoes($operacao16);
        $perfil1->addOperacoes($operacao16_0);
        $perfil1->addOperacoes($operacao17);
        $perfil1->addOperacoes($operacao17_0);
        $perfil1->addOperacoes($operacao18);
        $perfil1->addOperacoes($operacao19);
        $perfil1->addOperacoes($operacao20);
        $perfil1->addOperacoes($operacao20_0);
        $perfil1->addOperacoes($operacao21);
        $perfil1->addOperacoes($operacao21_0);
        $perfil1->addOperacoes($operacao22);
        $perfil1->addOperacoes($operacao23);
        $perfil1->addOperacoes($operacao24);
        $perfil1->addOperacoes($operacao24_0);
        $perfil1->addOperacoes($operacao25);
        $perfil1->addOperacoes($operacao25_0);
        $perfil1->addOperacoes($operacao26);
        $perfil1->addOperacoes($operacao27);
        $perfil1->addOperacoes($operacao28);
        $perfil1->addOperacoes($operacao28_0);
        $perfil1->addOperacoes($operacao28_1);
        $perfil1->addOperacoes($operacao28_2);
        $perfil1->addOperacoes($operacao28_3);
        $perfil1->addOperacoes($operacao29);
        $perfil1->addOperacoes($operacao29_0);
        $perfil1->addOperacoes($operacao29_1);
        $perfil1->addOperacoes($operacao29_2);
        $perfil1->addOperacoes($operacao30);
        $perfil1->addOperacoes($operacao31);


        //PERFIL 2
        $perfil2->addOperacoes($operacao0);
        $perfil2->addOperacoes($operacao1);
        $perfil2->addOperacoes($operacao2);
        $perfil2->addOperacoes($operacao3);
        $perfil2->addOperacoes($operacao4);
        $perfil2->addOperacoes($operacao8);             
        $perfil2->addOperacoes($operacao27);    
        $perfil2->addOperacoes($operacao29);    
        $perfil2->addOperacoes($operacao29_0);    
        $perfil2->addOperacoes($operacao30);    
        $perfil2->addOperacoes($operacao31);    

        
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
