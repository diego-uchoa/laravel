<?php

namespace App\Modules\Sisfone\Database\Seeds;

use Illuminate\Database\Seeder;

class SisfoneDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SISTEMA
        $this->call(SisfoneConfigSeeder::class);
        
        //TABELAS
        $this->call(TipoTelefoneSeeder::class);
        //$this->call(TelefoneSeeder::class);       
    }
}
