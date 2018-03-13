<?php

namespace App\Modules\Sisadm\Database\Seeds;

use Illuminate\Database\Seeder;

class SisadmDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SISTEMA CONFIG
        $this->call(SisadmConfigSeeder::class);
        
        //TABELAS
        $this->call(TipoAvisoSistemaSeeder::class);
        $this->call(AvisoSistemaSeeder::class);
        $this->call(TipoAvisoUsuarioSeeder::class);
        $this->call(AvisoUsuarioSeeder::class);        
        
    }
}
