<?php

namespace App\Modules\Sisadm\Database\Seeds;

use Illuminate\Database\Seeder;

class AvisoUsuarioSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            
            $usuario = \App\Modules\Sisadm\Models\User::where('nr_cpf','88958949104')->first();

            $avisoUsuario1 = factory(\App\Modules\Sisadm\Models\AvisoUsuario::class)->create([
                'tx_aviso_usuario' => 'Atualização do Sistema SISADM para versão 1.0.2.',
                'id_usuario' => $usuario->id_usuario,
            ]);

            $avisoUsuario2 = factory(\App\Modules\Sisadm\Models\AvisoUsuario::class)->create([
                'tx_aviso_usuario' => 'Atualização do Sistema SISADM para versão 1.0.3.',
                'id_usuario' => $usuario->id_usuario,           
            ]);
            
        }
}
