<?php

namespace App\Modules\Sismed\Database\Seeds;

use Illuminate\Database\Seeder;

class SismedDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SISTEMA CONFIG
        $this->call(SismedConfigSeeder::class);
        
        //TABELAS
        //$this->call(AreaAtendimentoSeeder::class);
        //$this->call(TipoAfastamentoSeeder::class);
        //$this->call(TipoPericiaSeeder::class);
        $this->call(ServidorSeeder::class);
        $this->call(ControleProntuarioSeeder::class);
        $this->call(AtestadoSeeder::class); 
    }
}
