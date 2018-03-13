<?php

namespace App\Modules\Sishelp\Database\Seeds;

use DB;

use Illuminate\Database\Seeder;


class AjudaGeralSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {

                $sistema = \App\Modules\Sisadm\Models\Sistema::where('no_sistema','SISADM')->first();

        	    $ajudaFaq1 = factory(\App\Modules\Sishelp\Models\AjudaGeral::class)->create([
                    'tx_ajuda_geral' => 'TEXTO',                    
                    'id_sistema' => $sistema->id_sistema,
                ]);
        }
}
