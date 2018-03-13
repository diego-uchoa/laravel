<?php

namespace App\Modules\Gescon\Database\Seeds;

use Illuminate\Database\Seeder;

class IndiceVariacaoSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'CCT',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'IGP-DI',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'IGP-M',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'INPC',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'IPCA',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'IPCA-E',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'EST',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'SELIC',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'IST',
            ]);
            $modalidade1 = factory(\App\Modules\Gescon\Models\IndiceVariacao::class)->create([
                'sg_indice_variacao' => 'IPC Alimentação',
            ]);
        }
}
