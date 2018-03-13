<?php

namespace App\Modules\Sisadm\Database\Seeds;

use Illuminate\Database\Seeder;

class AvisoSistemaSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $sistema = \App\Modules\Sisadm\Models\Sistema::where('no_sistema','SISADM')->first();

            $avisoSistema1 = factory(\App\Modules\Sisadm\Models\AvisoSistema::class)->create([
                'tx_aviso_sistema' => 'Atualização do Sistema SISADM para versão 1.0.2.',
                'id_sistema' => $sistema->id_sistema,
            ]);

            $avisoSistema2 = factory(\App\Modules\Sisadm\Models\AvisoSistema::class)->create([
                'tx_aviso_sistema' => 'Atualização do Sistema SISADM para versão 1.0.3.',
                'id_sistema' => $sistema->id_sistema,           
            ]);


        }
}
