<?php

namespace App\Modules\Gescon\Database\Seeds;

use Illuminate\Database\Seeder;

class ModalidadeSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $modalidade1 = factory(\App\Modules\Gescon\Models\Modalidade::class)->create([
                'no_modalidade' => 'CONVITE',
                'id_modalidade' => 1,
            ]);

            $modalidade2 = factory(\App\Modules\Gescon\Models\Modalidade::class)->create([
                'no_modalidade' => 'TOMADA DE PREÇOS',
                'id_modalidade' => 2,           
            ]);

            $modalidade3 = factory(\App\Modules\Gescon\Models\Modalidade::class)->create([
                'no_modalidade' => 'CONCORRÊNCIA',
                'id_modalidade' => 3,           
            ]);

            $modalidade4 = factory(\App\Modules\Gescon\Models\Modalidade::class)->create([
                'no_modalidade' => 'CONCORRÊNCIA INTERNACIONAL',
                'id_modalidade' => 4,           
            ]);

            $modalidade5 = factory(\App\Modules\Gescon\Models\Modalidade::class)->create([
                'no_modalidade' => 'PREGÃO',
                'id_modalidade' => 5,           
            ]);

            $modalidade6 = factory(\App\Modules\Gescon\Models\Modalidade::class)->create([
                'no_modalidade' => 'DISPENSA DE LICITAÇÃO',
                'id_modalidade' => 6,           
            ]);

            $modalidade7 = factory(\App\Modules\Gescon\Models\Modalidade::class)->create([
                'no_modalidade' => 'INEXIGIBILIDADE DE LICITAÇÃO',
                'id_modalidade' => 7,           
            ]);

        }
}
