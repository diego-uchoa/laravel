<?php

use Illuminate\Database\Seeder;

class FeriadoSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            
            $feriado1 = factory(\App\Modules\Sisadm\Models\Feriado::class)->create([
                'no_feriado' => 'Carnaval',
            ]);            
        }
    }
