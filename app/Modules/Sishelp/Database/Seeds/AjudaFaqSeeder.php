<?php

namespace App\Modules\Sishelp\Database\Seeds;

use DB;

use Illuminate\Database\Seeder;


class AjudaFaqSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {

                $sistema = \App\Modules\Sisadm\Models\Sistema::where('no_sistema','SISADM')->first();

        	    $ajudaFaq1 = factory(\App\Modules\Sishelp\Models\AjudaFaq::class)->create([
                    'tx_pergunta' => 'Como cadastrar um usuário?',                    
                    'id_sistema' => $sistema->id_sistema,
                ]);

                $ajudaFaq2 = factory(\App\Modules\Sishelp\Models\AjudaFaq::class)->create([
                    'tx_pergunta' => 'Quais os perfis do sistema?',
                    'id_sistema' => $sistema->id_sistema,         
                ]);          
        }
}
