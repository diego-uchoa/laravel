<?php

namespace App\Modules\Prisma\Database\Seeds;

use Illuminate\Database\Seeder;

use App\Modules\Sisadm\Models\User;

class PrismaConfigSeeder extends Seeder
{
    
    //CONSTANTES DO SISTEMA
    const SISTEMA = 'PRISMA';
    const SISTEMA_DESCRICAO = 'Prisma';
    const SISTEMA_MODULO = 'prisma';

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
            'tx_beneficio' => 'Sistema de coleta de expectativas de mercado para acompanhar a evolução das principais variáveis fiscais brasileiras',
            'tx_publico' => 'Servidores do Ministério da Fazenda e empresas de mercado',
            'co_esquema' => 'spoa_portal_prisma_s1',
            'sn_ativo' => true,
            'sn_tela_inicial' => true,
            'no_responsavel' => 'Luísa Palmeira',
            'tx_email_responsavel' => 'luisa.palmeira@fazenda.gov.br',
            'id_area' => 3,
            'nr_ordem' => 5
        ]);      

        /***********************************************************************************************
        /*  PERFIL
        /*
        /***********************************************************************************************/
        $perfil1 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-Gestor',
            'ds_perfil' => self::SISTEMA.'- Responsável da SPE',
            'id_sistema' => $sistema->id_sistema
        ]);

        
        $perfil2 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-EditorSPE',
            'ds_perfil' => self::SISTEMA.'- Editor da SPE',
            'id_sistema' => $sistema->id_sistema
        ]);

        $perfil3 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-ResponsavelInstituicao',
            'ds_perfil' => self::SISTEMA.'- Responsável da Instituição',
            'id_sistema' => $sistema->id_sistema
        ]);

        
        $perfil4 = factory(\App\Modules\Sisadm\Models\Perfil::class)->create([
            'no_perfil' => self::SISTEMA.'-EditorInstituicao',
            'ds_perfil' => self::SISTEMA.'- Editor da Instituição',
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
            'no_operacao'=> self::SISTEMA_MODULO.'::solicitacao.cadastro.index',
            'ds_operacao'=> 'Listar solicitações de Cadastro',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao2 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::solicitacao.cadastro.edit',
            'ds_operacao'=> 'Editar solicitação de cadastro',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao3 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes.index',
            'ds_operacao'=> 'Listar instituições',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao4 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes.edit.nome_relatorio',
            'ds_operacao'=> 'Editar nome em relatório',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao5 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes.edit.instituicao_responsavel_previsao',
            'ds_operacao'=> 'Editar instituição responsável pela previsão',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao6 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes.destroy.instituicao_responsavel_previsao',
            'ds_operacao'=> 'Excluir instituição responsável pela previsão',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao7 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.edit.responsavel',
            'ds_operacao'=> 'Editar dados do responsável',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao8 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.change.responsavel',
            'ds_operacao'=> 'Substituir responsável',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao9 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.destroy.responsavel',
            'ds_operacao'=> 'Remover responsável',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao10 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.create.responsavel',
            'ds_operacao'=> 'Adicionar responsável',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao11 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes.show.todas',
            'ds_operacao'=> 'Listar dados da instituição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao12 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.edit.editor',
            'ds_operacao'=> 'Editar dados do editor',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao13 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.destroy.editor',
            'ds_operacao'=> 'Excluir editor',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao14 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::usuarios.create.editor',
            'ds_operacao'=> 'Adicionar editor',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao15 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes_responsavel_previsao.index',
            'ds_operacao'=> 'Listar instituições responsáveis pelas previsões',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao16 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes_responsavel_previsao.store',
            'ds_operacao'=> 'Adicionar instituição responsável pela previsão',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao17 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes_responsavel_previsao.edit',
            'ds_operacao'=> 'Editar instituição responsável pela previsão',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao18 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes_responsavel_previsao.destroy',
            'ds_operacao'=> 'Excluir instituição responsável pela previsão',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao19 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::instituicoes.show.minha',
            'ds_operacao'=> 'Listar dados da minha instituição',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao20 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfil.gestores',
            'ds_operacao'=> 'Perfil de gestor do Prisma',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);

        $operacao21 = factory(\App\Modules\Sisadm\Models\Operacao::class)->create([
            'no_operacao'=> self::SISTEMA_MODULO.'::perfil.instituicoes',
            'ds_operacao'=> 'Perfil de usuário de instituição do Prisma',
            'sn_favorita'=> false,
            'id_sistema' => $sistema->id_sistema,        
        ]);
        

        //ATRIBUICAO DE OPERACAO PARA PEFIL

        //GESTOR DA SPE
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
        $perfil1->addOperacoes($operacao20);

        //EDITOR DA SPE
        $perfil2->addOperacoes($operacao0);
        $perfil2->addOperacoes($operacao1);
        $perfil2->addOperacoes($operacao2);
        $perfil2->addOperacoes($operacao3);
        $perfil2->addOperacoes($operacao4);
        $perfil2->addOperacoes($operacao5);
        $perfil2->addOperacoes($operacao6);
        $perfil2->addOperacoes($operacao7);
        $perfil2->addOperacoes($operacao8);
        $perfil2->addOperacoes($operacao9);
        $perfil2->addOperacoes($operacao10);
        $perfil2->addOperacoes($operacao11);
        $perfil2->addOperacoes($operacao12);
        $perfil2->addOperacoes($operacao13);
        $perfil2->addOperacoes($operacao14);
        $perfil2->addOperacoes($operacao15);
        $perfil2->addOperacoes($operacao16);
        $perfil2->addOperacoes($operacao17);
        $perfil2->addOperacoes($operacao18);
        $perfil2->addOperacoes($operacao20);

        //RESPONSÁVEL DA INSTITUIÇÃO
        $perfil3->addOperacoes($operacao0);
        $perfil3->addOperacoes($operacao4);
        $perfil3->addOperacoes($operacao7);
        $perfil3->addOperacoes($operacao8);
        $perfil3->addOperacoes($operacao9);
        $perfil3->addOperacoes($operacao19);
        $perfil3->addOperacoes($operacao12);
        $perfil3->addOperacoes($operacao13);
        $perfil3->addOperacoes($operacao14);
        $perfil3->addOperacoes($operacao21);


        //EDITOR DA INSTITUIÇÃO
        $perfil4->addOperacoes($operacao0);
        $perfil4->addOperacoes($operacao4);
        $perfil4->addOperacoes($operacao19);
        $perfil4->addOperacoes($operacao21);

        
        //ATRIBUICAO DE PERFIL ADMINISTRADOR PARA USUARIOS 1,2,3,4
        $user3 =User::find(3);  //Andre Boaro      
        $user3->addPerfil($perfil1);

        $user4 =User::find(4);  //Luisa Palmeira        
        $user4->addPerfil($perfil1);



        /***********************************************************************************************
        /*  ITENS DE MENU
        /*
        /***********************************************************************************************/
        $menu1 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Solicitações de Cadastro',
            'rota' => self::SISTEMA_MODULO.'::solicitacao.cadastro.index',
            'ordem' => '10',
            'icon' => 'menu-icon ace-icon fa fa-list-alt',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao1->id_operacao          
        ]);

        $menu2 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Instituições',
            'rota' => self::SISTEMA_MODULO.'::instituicoes.index',
            'ordem' => '20',
            'icon' => 'menu-icon ace-icon fa fa-university',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao11->id_operacao          
        ]);

        $menu3 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Minha Instituição',
            'rota' => self::SISTEMA_MODULO.'::instituicoes.show.minha',
            'ordem' => '40',
            'icon' => 'menu-icon ace-icon fa fa-university',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao19->id_operacao          
        ]);

        $menu4 = factory(\App\Modules\Sisadm\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Responsável pela Previsão',
            'rota' => self::SISTEMA_MODULO.'::instituicoes_responsavel_previsao.index',
            'ordem' => '50',
            'icon' => 'menu-icon ace-icon fa fa-link',
            'tipo' => 'raiz',
            'id_sistema' => $sistema->id_sistema,
            'id_operacao' => $operacao15->id_operacao          
        ]);

        
    }
}
