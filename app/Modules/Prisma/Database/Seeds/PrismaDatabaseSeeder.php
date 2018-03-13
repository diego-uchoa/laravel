<?php

namespace App\Modules\Prisma\Database\Seeds;

use Illuminate\Database\Seeder;

class PrismaDatabaseSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */

    public function run() {
      //SISTEMA
      $this->call(PrismaConfigSeeder::class);
      // $this->call(DadosTesteSeeder::class);
    }
}