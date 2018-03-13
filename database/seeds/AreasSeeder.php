<?php

use Illuminate\Database\Seeder;
use App\Modules\Sisadm\Models\Area;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areaGP = factory(\App\Modules\Sisadm\Models\Area::class)->create([
            'no_area' => 'Gestão de Pessoas',
            'ds_area' => 'Sistemas para a Gestão de Pessoas'
        ]);

        $areaRL = factory(\App\Modules\Sisadm\Models\Area::class)->create([
            'no_area' => 'Recursos Logísticos',
            'ds_area' => 'Sistemas para a gestão de Recursos Logísticos'
        ]);

        $areaTI = factory(\App\Modules\Sisadm\Models\Area::class)->create([
            'no_area' => 'Tecnologia da Informação',
            'ds_area' => 'Sistemas para a gestão de Tecnologia da Informação'
        ]);
    }
}
