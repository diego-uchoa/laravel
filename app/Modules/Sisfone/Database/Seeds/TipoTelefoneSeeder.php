<?php

namespace App\Modules\Sisfone\Database\Seeds;

use Illuminate\Database\Seeder;

class TipoTelefoneSeeder extends Seeder
{
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {

       /*
       $tipoTelefone1 = factory(\App\Modules\Sisfone\Models\TipoTelefone::class)->create([
         'no_tipo_telefone' => 'CEL'
       ]);
       */     

       /*

       'title' => $faker->realText($maxNbChars = 20, $indexSize = 2),
              'content' => $faker->realText($maxNbChars = 800, $indexSize = 2),
              'description'=> $faker->realText($maxNbChars = 250, $indexSize = 2),
              'is_public'=> $faker->randomElement(array(0,1)),
              'status'=> $faker->randomElement(array('published', 'draft', 'outdated')),
              'published_at'=> $faker->dateTime($max = 'now'),
              'is_commentable'=> $faker->randomElement(array(0,1)),
        */   

       
       factory(\App\Modules\Sisfone\Models\TipoTelefone::class, 3)->create()->each(function ($c) {
         $c->telefones()->saveMany(factory(\App\Modules\Sisfone\Models\Telefone::class)->times(5)->make());
       });
       
     }
}
