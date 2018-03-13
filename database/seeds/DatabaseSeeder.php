<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        //TABELAS AUXILIARES
        $this->call(UfsSeeder::class);
        $this->call(MunicipiosSeeder::class);
      
        
        //TABELAS SISTEMA
        $this->call(AreasSeeder::class);
        $this->call(OrgaosSeeder::class);
        $this->call(UsuariosSeeder::class);

        //TABELAS INICIO
        //Esse seeder está com problema de -> The separation symbol could not be found
        //$this->call(FeriadoSeeder::class);
        $this->call(EventoSeeder::class);
 
    }
}
