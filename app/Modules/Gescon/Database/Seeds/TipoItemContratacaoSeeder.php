<?php

namespace App\Modules\Gescon\Database\Seeds;

use Illuminate\Database\Seeder;

class TipoItemContratacaoSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $Item1 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'BG',
                'ds_tipo_item_contratacao' => 'Brigada Diurno',
            ]);

            $Item2 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'BG',
                'ds_tipo_item_contratacao' => 'Brigada Noturno',
            ]);

            $Item3 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'BG',
                'ds_tipo_item_contratacao' => 'Líder',
            ]);

            $Item4 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'BG',
                'ds_tipo_item_contratacao' => 'Mestre',
            ]);

            $Item5 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'VG',
                'ds_tipo_item_contratacao' => 'Vigilante Diurno 12x36',
            ]);

            $Item6 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'VG',
                'ds_tipo_item_contratacao' => 'Vigilante Noturno 12x36',
            ]);

            $Item7 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'VG',
                'ds_tipo_item_contratacao' => 'Vigilante Diurno 5x2',
            ]);

            $Item8 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'VG',
                'ds_tipo_item_contratacao' => 'SPP Diurno 12x36',
            ]);

            $Item9 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'VG',
                'ds_tipo_item_contratacao' => 'SPP Diurno 5x2',
            ]);

            $Item10 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'VG',
                'ds_tipo_item_contratacao' => 'Preposto Diurno 12x36',
            ]);

            $Item11 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Técnico em Secretariado',
            ]);

            $Item12 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Secretária Executiva',
            ]);

            $Item13 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Recepcionista',
            ]);

            $Item14 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Atendente',
            ]);

            $Item15 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Carregador',
            ]);

            $Item16 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Copeira',
            ]);

            $Item17 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Maitre',
            ]);

            $Item18 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Garçom',
            ]);

            $Item19 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Chefe de Cozinha',
            ]);

            $Item20 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Ascensorista',
            ]);

            $Item21 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Motorista Executivo',
            ]);

            $Item22 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Motorista de Serviço',
            ]);

            $Item23 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Técnico em Telecomunicações',
            ]);

            $Item24 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Lavador',
            ]);

            $Item25 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'TR',
                'ds_tipo_item_contratacao' => 'Mecânico',
            ]);

            $Item26 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Administrativa',
            ]);

            $Item27 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Escritórios',
            ]);

            $Item28 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Corredores',
            ]);

            $Item29 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Hall',
            ]);

            $Item30 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Sanitários',
            ]);

            $Item31 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Refeitório',
            ]);

            $Item32 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Auditórios',
            ]);

            $Item33 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Reuniões',
            ]);

            $Item34 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Depósitos',
            ]);

            $Item35 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Almoxarifado',
            ]);

            $Item36 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Médico-hospitalar',
            ]);

            $Item37 = factory(\App\Modules\Gescon\Models\TipoItemContratacao::class)->create([
                'in_objeto' => 'LP',
                'ds_tipo_item_contratacao' => 'Externas',
            ]);
        }
}
