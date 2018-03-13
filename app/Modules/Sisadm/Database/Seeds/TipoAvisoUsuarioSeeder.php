<?php

namespace App\Modules\Sisadm\Database\Seeds;

use Illuminate\Database\Seeder;

class TipoAvisoUsuarioSeeder extends Seeder
{
       /**
        * Run the database seeds.
        *
        * @return void
        */
       public function run()
       {
        $tipoAvisoUsuario1 = factory(\App\Modules\Sisadm\Models\TipoAvisoUsuario::class)->create([
         'no_tipo_aviso_usuario' => 'Notificação'            
         ]);

        $tipoAvisoUsuario2 = factory(\App\Modules\Sisadm\Models\TipoAvisoUsuario::class)->create([
         'no_tipo_aviso_usuario' => 'Pendência'            
         ]);
      }
    }
