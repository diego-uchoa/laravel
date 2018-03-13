<?php

namespace App\Modules\Sismed\Database\Seeds;

use Illuminate\Database\Seeder;

class AtestadoSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            
            $atestado1 = factory(\App\Modules\Sismed\Models\Atestado::class)->create([
                'id_servidor'   => 1,
                'in_area_atendimento'   => 'M',
                'in_tipo_afastamento'   => 'P',
                'in_tipo_pericia'       => 'S',
                'te_prazo'         => 10,
                'nr_crm'        => 1234,
                'no_medico'     => 'Nome do Médico',
                'dt_inicio_afastamento' => '01/01/2015',
                'dt_fim_afastamento'    => '09/01/2015',
            ]);

            $pericia1 = factory(\App\Modules\Sismed\Models\Pericia::class)->create([
                'id_atestado' => 1,
                'in_tipo_pericia' => 'S',
                'te_prazo' => 10,
                'dt_inicio_afastamento' => '01/01/2015',
                'dt_fim_afastamento' => '09/01/2015',
                'in_situacao' => 'A'
            ]);


            $controleCiclo1 = factory(\App\Modules\Sismed\Models\ControleCiclo::class)->create([
                'id_servidor' => 1,
                'id_atestado_origem' => 1,
                'dt_inicio_ciclo' => '2015-01-01',
                'dt_fim_ciclo' => '2015-12-31',
                'va_adicional_ciclo_anterior' => 0
            ]);


            $atestado2 = factory(\App\Modules\Sismed\Models\Atestado::class)->create([
                'id_servidor'   => 1,
                'in_area_atendimento'   => 'M',
                'in_tipo_afastamento'   => 'P',
                'in_tipo_pericia'       => 'S',
                'te_prazo'         => 10,
                'nr_crm'        => 1234,
                'no_medico'     => 'Nome do Médico',
                'dt_inicio_afastamento' => '01/02/2015',
                'dt_fim_afastamento'    => '09/02/2015',
            ]);

            $pericia2 = factory(\App\Modules\Sismed\Models\Pericia::class)->create([
                'id_atestado' => 2,
                'in_tipo_pericia' => 'S',
                'te_prazo' => 10,
                'dt_inicio_afastamento' => '01/02/2015',
                'dt_fim_afastamento' => '09/02/2015',
                'in_situacao' => 'A'
            ]);











            $atestado3 = factory(\App\Modules\Sismed\Models\Atestado::class)->create([
                'id_servidor'   => 1,
                'in_area_atendimento'   => 'M',
                'in_tipo_afastamento'   => 'P',
                'in_tipo_pericia'       => 'S',
                'te_prazo'         => 10,
                'nr_crm'        => 1234,
                'no_medico'     => 'Nome do Médico',
                'dt_inicio_afastamento' => '01/01/2016',
                'dt_fim_afastamento'    => '09/01/2016'
            ]);

            $pericia3 = factory(\App\Modules\Sismed\Models\Pericia::class)->create([
                'id_atestado' => 3,
                'in_tipo_pericia' => 'S',
                'te_prazo' => 10,
                'dt_inicio_afastamento' => '01/01/2016',
                'dt_fim_afastamento' => '09/01/2016',
                'in_situacao' => 'A'
            ]);


            $controleCiclo2 = factory(\App\Modules\Sismed\Models\ControleCiclo::class)->create([
                'id_servidor' => 1,
                'id_atestado_origem' => 3,
                'dt_inicio_ciclo' => '2016-01-01',
                'dt_fim_ciclo' => '2016-12-31',
                'va_adicional_ciclo_anterior' => 0
            ]);

            $atestado4 = factory(\App\Modules\Sismed\Models\Atestado::class)->create([
                'id_servidor'   => 1,
                'in_area_atendimento'   => 'M',
                'in_tipo_afastamento'   => 'P',
                'in_tipo_pericia'       => 'S',
                'te_prazo'         => 10,
                'nr_crm'        => 1234,
                'no_medico'     => 'Nome do Médico',
                'dt_inicio_afastamento' => '01/02/2016',
                'dt_fim_afastamento'    => '09/02/2016'
            ]);

            $pericia4 = factory(\App\Modules\Sismed\Models\Pericia::class)->create([
                'id_atestado' => 4,
                'in_tipo_pericia' => 'S',
                'te_prazo' => 10,
                'dt_inicio_afastamento' => '01/02/2016',
                'dt_fim_afastamento' => '09/02/2016',
                'in_situacao' => 'A'
            ]);








            $atestado5 = factory(\App\Modules\Sismed\Models\Atestado::class)->create([
                'id_servidor'   => 1,
                'in_area_atendimento'   => 'M',
                'in_tipo_afastamento'   => 'P',
                'in_tipo_pericia'       => 'S',
                'te_prazo'         => 10,
                'nr_crm'        => 1234,
                'no_medico'     => 'Nome do Médico',
                'dt_inicio_afastamento' => '01/01/2017',
                'dt_fim_afastamento'    => '09/01/2017'
            ]);

            $pericia5 = factory(\App\Modules\Sismed\Models\Pericia::class)->create([
                'id_atestado' => 5,
                'in_tipo_pericia' => 'S',
                'te_prazo' => 10,
                'dt_inicio_afastamento' => '01/01/2017',
                'dt_fim_afastamento' => '09/01/2017',
                'in_situacao' => 'A'
            ]);


            $controleCiclo3 = factory(\App\Modules\Sismed\Models\ControleCiclo::class)->create([
                'id_servidor' => 1,
                'id_atestado_origem' => 5,
                'dt_inicio_ciclo' => '2017-01-01',
                'dt_fim_ciclo' => '2017-12-31',
                'va_adicional_ciclo_anterior' => 0
            ]);

            $atestado6 = factory(\App\Modules\Sismed\Models\Atestado::class)->create([
                'id_servidor'   => 1,
                'in_area_atendimento'   => 'M',
                'in_tipo_afastamento'   => 'P',
                'in_tipo_pericia'       => 'S',
                'te_prazo'         => 10,
                'nr_crm'        => 1234,
                'no_medico'     => 'Nome do Médico',
                'dt_inicio_afastamento' => '01/02/2017',
                'dt_fim_afastamento'    => '09/02/2017'
            ]);

            $pericia6 = factory(\App\Modules\Sismed\Models\Pericia::class)->create([
                'id_atestado' => 6,
                'in_tipo_pericia' => 'S',
                'te_prazo' => 10,
                'dt_inicio_afastamento' => '01/02/2017',
                'dt_fim_afastamento' => '09/02/2017',
                'in_situacao' => 'A'
            ]);



            $atestado1->id_controle_ciclo = 1; $atestado1->save();
            $atestado2->id_controle_ciclo = 1; $atestado2->save();
            $atestado3->id_controle_ciclo = 2; $atestado3->save();
            $atestado4->id_controle_ciclo = 2; $atestado4->save();            
            $atestado5->id_controle_ciclo = 3; $atestado5->save();
            $atestado6->id_controle_ciclo = 3; $atestado6->save();

        }
    }
