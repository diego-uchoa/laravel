<?php

namespace App\Modules\Prisma\Database\Seeds;

use Illuminate\Database\Seeder;

class DadosTesteSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            
            $solicitacao = factory(\App\Modules\Prisma\Models\SolicitacaoCadastro::class)->create([
                'nr_cnpj'   =>  '70851293000104',
                'no_razao_social'   =>  'MR Consultoria Financeira Ltda',
                'no_relatorio' => 'Teste',
                'no_situacao' =>  'ATIVO',
                'nr_telefone'   =>  '1726796865',
                'ds_email'   =>  'contato@mrconsultoriafinanceira.com.br',
                'ed_cep_logradouro'   =>  '14786043',
                'ed_logradouro'   =>  'Travessa Itamaracá',
                'ed_numero_logradouro'   =>  '602',
                'ed_complemento_logradouro'   =>  'Lote 06',
                'ed_bairro_logradouro'   =>  'Joaquim Pereira Mococa',
                'ed_municipio_logradouro'   =>  'Barretos',
                'ed_sigla_uf'   =>  'SP',
                'nr_cpf_responsavel'   =>  '02119117390',
                'no_responsavel'   =>  'Anthony Danilo Enrico Martins',
                'nr_telefone_responsavel'   =>  '(21) 9999-9999',
                'ds_email_responsavel'   =>  'andre.boaro@fazenda.gov.br',
                'no_cargo_responsavel'   =>  'Sócio',
                'in_situacao_solicitacao'   =>  'P'
            ]);

            
            $editor1 = factory(\App\Modules\Prisma\Models\SolicitacaoCadastroEditor::class)->create([
                'nr_cpf'   =>  '88789485513',
                'no_editor'   =>  'Vitor Henry Danilo Rodrigues',
                'ds_email'   =>  'andre.boaro@fazenda.gov.br',
                'nr_telefone'   =>  '9838139386',
                'id_solicitacao_cadastro'   =>  $solicitacao->id_solicitacao_cadastro,
            ]);

            $editor2 = factory(\App\Modules\Prisma\Models\SolicitacaoCadastroEditor::class)->create([
                'nr_cpf'   =>  '70783738048',
                'no_editor'   =>  'Breno Giovanni Davi Souza',
                'ds_email'   =>  'andre.boaro@fazenda.gov.br',
                'nr_telefone'   =>  '9838139386',
                'id_solicitacao_cadastro'   =>  $solicitacao->id_solicitacao_cadastro,
            ]);

            $solicitacao1 = factory(\App\Modules\Prisma\Models\SolicitacaoCadastro::class)->create([
                'nr_cnpj'   =>  '10437167000178',
                'no_razao_social'   =>  'Invest Management',
                'no_relatorio' => 'Teste222',
                'no_situacao' =>  'ATIVO',
                'nr_telefone'   =>  '1726796865',
                'ds_email'   =>  'contato@investmanagement.com.br',
                'ed_cep_logradouro'   =>  '25025102',
                'ed_logradouro'   =>  'Avenida Henrique Valadares',
                'ed_numero_logradouro'   =>  '239',
                'ed_complemento_logradouro'   =>  'Sala 1212',
                'ed_bairro_logradouro'   =>  'Centro',
                'ed_municipio_logradouro'   =>  'Rio de Janeiro',
                'ed_sigla_uf'   =>  'RJ',
                'nr_cpf_responsavel'   =>  '43370528878',
                'no_responsavel'   =>  'Benjamin Calebe Rocha',
                'nr_telefone_responsavel'   =>  '(21) 9999-9999',
                'ds_email_responsavel'   =>  'andre.boaro@fazenda.gov.br',
                'no_cargo_responsavel'   =>  'Sócio',
                'in_situacao_solicitacao'   =>  'A'
            ]);

            $editor3 = factory(\App\Modules\Prisma\Models\SolicitacaoCadastroEditor::class)->create([
                'nr_cpf'   =>  '54577209187',
                'no_editor'   =>  'Ian Kevin Julio Dias',
                'ds_email'   =>  'ian@investmanagement.com.br',
                'nr_telefone'   =>  '9838139386',
                'id_solicitacao_cadastro'   =>  $solicitacao1->id_solicitacao_cadastro,
            ]);

            $editor4 = factory(\App\Modules\Prisma\Models\SolicitacaoCadastroEditor::class)->create([
                'nr_cpf'   =>  '43592167936',
                'no_editor'   =>  'Levi Guilherme dos Santos',
                'ds_email'   =>  'levi@investmanagement.com.br',
                'nr_telefone'   =>  '4135158556',
                'id_solicitacao_cadastro'   =>  $solicitacao1->id_solicitacao_cadastro,
            ]);

            $instituicao = factory(\App\Modules\Prisma\Models\Instituicao::class)->create([
                'nr_cnpj'   =>  '10437167000178',
                'no_razao_social'   =>  'Invest Management',
                'no_relatorio' => 'Teste333',
                'no_situacao' =>  'ATIVO',
                'nr_telefone'   =>  '1726796865',
                'ds_email'   =>  'contato@investmanagement.com.br',
                'ed_cep_logradouro'   =>  '25025102',
                'ed_logradouro'   =>  'Avenida Henrique Valadares',
                'ed_numero_logradouro'   =>  '239',
                'ed_complemento_logradouro'   =>  'Sala 1212',
                'ed_bairro_logradouro'   =>  'Centro',
                'ed_municipio_logradouro'   =>  'Municipio',
                'ed_sigla_uf'   =>  'RJ',
                'nr_cpf_responsavel'   =>  '43370528878',
                'no_responsavel'   =>  'Benjamin Calebe Rocha',
                'nr_telefone_responsavel'   =>  '(21) 9999-9999',
                'ds_email_responsavel'   =>  'benjamincaleberocha@investmanagement.com.br',
                'no_cargo_responsavel'   =>  'Sócio',
                'id_solicitacao_cadastro'   =>  2
            ]);
  

        }
    }
