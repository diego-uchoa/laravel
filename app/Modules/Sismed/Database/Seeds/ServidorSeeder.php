<?php

namespace App\Modules\Sismed\Database\Seeds;

use Illuminate\Database\Seeder;

class ServidorSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            
            $servodor1 = factory(\App\Modules\Sismed\Models\Servidor::class)->create([
                'nr_cpf'    => '69378746187',
                'ds_email'  => 'alan.melo@fazenda.gov.br',
                'no_servidor' => 'ALAN KARDEC L S DE MELO',
                'dt_nascimento' => '01/04/1988',
                'in_sexo' => 'M',
                'tx_telefone_unidade' => '(61) 3412-3829',
                'tx_telefone_celular' => '(61) 3412-0000',
                'tx_telefone_residencial' => '(61) 3412-1111',
                'nr_siape' => '1998777',
                'no_cargo' => 'ASSISTENTE TECNICO-ADMINISTRATIVO',
                'nr_rg' => '2272966',
                'no_orgao' => 'MF',
                'no_unidade_lotacao'  => 'SPOA/COGTI',
                'no_unidade_exercicio'  => 'SPOA/COGTI',
                'in_regime_juridico' => 'CLT',
                'co_prontuario'  => '0A'
            ]);

            $servodor1 = factory(\App\Modules\Sismed\Models\Servidor::class)->create([
                'nr_cpf'    => '70822921120',
                'ds_email'  => 'andre.boaro@fazenda.gov.br',
                'no_servidor' => 'ANDRE BOARO',
                'dt_nascimento' => '01/10/1985',
                'in_sexo' => 'M',
                'tx_telefone_unidade' => '(61) 3412-3829',
                'tx_telefone_celular' => '(61) 3412-0000',
                'tx_telefone_residencial' => '(61) 3412-1111',
                'nr_siape' => '1999888',
                'no_cargo' => 'ANALISTA TECNOLOGIA INFORMAÇÃO',
                'nr_rg' => '99999999',
                'no_orgao' => 'MF',
                'no_unidade_lotacao'  => 'SPOA/COGTI',
                'no_unidade_exercicio'  => 'SPOA/COGTI',
                'in_regime_juridico' => 'EST',
                'co_prontuario'  => '1A'
            ]);
        }
    }
