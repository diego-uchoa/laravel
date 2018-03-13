<?php

namespace App\Modules\Sisadm\Database\Seeds;

use Illuminate\Database\Seeder;

class TipoAvisoSistemaSeeder extends Seeder
{
       /**
        * Run the database seeds.
        *
        * @return void
        */
       public function run()
       {

        $tipoAvisoSistema1 = factory(\App\Modules\Sisadm\Models\TipoAvisoSistema::class)->create([
          'no_tipo_aviso_sistema' => 'Notificação'            
          ]);

        $tipoAvisoSistema2 = factory(\App\Modules\Sisadm\Models\TipoAvisoSistema::class)->create([
          'no_tipo_aviso_sistema' => 'Pendência'            
          ]);

        $tipoAvisoSistema3 = factory(\App\Modules\Sisadm\Models\TipoAvisoSistema::class)->create([
          'no_tipo_aviso_sistema' => 'Atualização'         
          ]);

      }
}
