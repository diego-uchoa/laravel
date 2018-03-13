<?php

namespace App\Modules\Sishelp\Database\Seeds;

use Illuminate\Database\Seeder;

class SishelpDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SISTEMA
        $this->call(SishelpConfigSeeder::class);
        
        //TABELAS
        $this->call(AjudaFaqSeeder::class);
        $this->call(AjudaArquivoSeeder::class);       
        $this->call(AjudaGeralSeeder::class);       
    }
}
