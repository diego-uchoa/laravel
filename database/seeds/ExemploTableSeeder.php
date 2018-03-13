<?php

use Illuminate\Database\Seeder;


class ExemploTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $this->disableForeignKeys();
      $this->truncate('exemplo');

      $types = [
      [
      'id_exemplo' => 1,
      'no_exemplo' => 'nome1',
      'ds_exemplo' => 'descricao1',	                    	
      ],
      [
      'id_exemplo' => 2,
      'no_exemplo' => 'nome2',
      'ds_exemplo' => 'descricao2',                         
      ], 

      [
      'id_exemplo' => 3,
      'no_exemplo' => 'nome3',
      'ds_exemplo' => 'descricao3',                         
      ],
      ]);

      DB::table('exemplo')->insert($types);

      $this->enableForeignKeys();
    }
  }
