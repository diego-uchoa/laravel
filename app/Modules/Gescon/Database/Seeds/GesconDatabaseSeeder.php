<?php

namespace App\Modules\Gescon\Database\Seeds;

use Illuminate\Database\Seeder;

class GesconDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SISTEMA CONFIG
        $this->call(GesconConfigSeeder::class);
        
        //TABELAS
        $this->call(ModalidadeSeeder::class);
        $this->call(EdificioSeeder::class);
        $this->call(IndiceVariacaoSeeder::class);
        $this->call(TipoItemContratacaoSeeder::class);
    }
}
