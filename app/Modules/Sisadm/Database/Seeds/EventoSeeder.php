<?php

namespace App\Modules\Sisadm\Database\Seeds;

use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {            

            $usuario = \App\Modules\Sisadm\Models\User::where('nr_cpf','88958949104')->first();

            $evento1 = factory(\App\Modules\Sisadm\Models\Evento::class)->create([
                'id_usuario' => $usuario->id_usuario,
            ]);
        }
}
