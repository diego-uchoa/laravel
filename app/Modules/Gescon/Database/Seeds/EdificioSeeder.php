<?php

namespace App\Modules\Gescon\Database\Seeds;

use Illuminate\Database\Seeder;

class EdificioSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $sistema = \App\Modules\Sisadm\Models\Sistema::where('no_sistema','GESCON')->first();

            $modalidade1 = factory(\App\Modules\Gescon\Models\Edificio::class)->create([
                'co_edificio' => 'DF0001',
                'no_edificio' => 'ED. SEDE',
                'sg_uf' => 'DF',
            ]);

            $modalidade1 = factory(\App\Modules\Gescon\Models\Edificio::class)->create([
                'co_edificio' => 'DF0002',
                'no_edificio' => 'ED. ÓRGÃOS REGIONAIS',
                'sg_uf' => 'DF',
            ]);

            $modalidade1 = factory(\App\Modules\Gescon\Models\Edificio::class)->create([
                'co_edificio' => 'DF0003',
                'no_edificio' => 'ED. ÓRGÃOS CENTRAIS',
                'sg_uf' => 'DF',
            ]);

            $modalidade1 = factory(\App\Modules\Gescon\Models\Edificio::class)->create([
                'co_edificio' => 'DF0004',
                'no_edificio' => 'ED. ANEXO',
                'sg_uf' => 'DF',
            ]);

            $modalidade1 = factory(\App\Modules\Gescon\Models\Edificio::class)->create([
                'co_edificio' => 'RJ0001',
                'no_edificio' => 'ED. SEDE SAMF/RJ',
                'sg_uf' => 'RJ',
            ]);

            $modalidade1 = factory(\App\Modules\Gescon\Models\Edificio::class)->create([
                'co_edificio' => 'GO0013',
                'no_edificio' => 'DRF GOIANIA/GO - PREDIO NOVO',
                'sg_uf' => 'GO',
            ]);

            $modalidade1 = factory(\App\Modules\Gescon\Models\Edificio::class)->create([
                'co_edificio' => 'GO0043',
                'no_edificio' => 'ED. SAMF-GO/TO',
                'sg_uf' => 'GO',
            ]);

        }
}
