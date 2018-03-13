<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UfsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mf.uf')->insert([
            "id_uf" => 11,
            "sg_uf" => "RO",
            "no_uf" => "RONDÔNIA",
            "created_at" => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 12,
            'sg_uf' => 'AC',
            'no_uf' => 'ACRE',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 13,
            'sg_uf' => 'AM',
            'no_uf' => 'AMAZONAS',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 14,
            'sg_uf' => 'RR',
            'no_uf' => 'RORAIMA',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 15,
            'sg_uf' => 'PA',
            'no_uf' => 'PARÁ',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 16,
            'sg_uf' => 'AP',
            'no_uf' => 'AMAPÁ',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 17,
            'sg_uf' => 'TO',
            'no_uf' => 'TOCANTINS',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 21,
            'sg_uf' => 'MA',
            'no_uf' => 'MARANHÃO',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 22,
            'sg_uf' => 'PI',
            'no_uf' => 'PIAUÍ',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 23,
            'sg_uf' => 'CE',
            'no_uf' => 'CEARÁ',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 24,
            'sg_uf' => 'RN',
            'no_uf' => 'RIO GRANDE DO NORTE',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 25,
            'sg_uf' => 'PB',
            'no_uf' => 'PARAÍBA',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 26,
            'sg_uf' => 'PE',
            'no_uf' => 'PERNAMBUCO',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 27,
            'sg_uf' => 'AL',
            'no_uf' => 'ALAGOAS',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 28,
            'sg_uf' => 'SE',
            'no_uf' => 'SERGIPE',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 29,
            'sg_uf' => 'BA',
            'no_uf' => 'BAHIA',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 31,
            'sg_uf' => 'MG',
            'no_uf' => 'MINAS GERAIS',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 32,
            'sg_uf' => 'ES',
            'no_uf' => 'ESPÍRITO SANTO',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 33,
            'sg_uf' => 'RJ',
            'no_uf' => 'RIO DE JANEIRO',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 35,
            'sg_uf' => 'SP',
            'no_uf' => 'SÃO PAULO',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 41,
            'sg_uf' => 'PR',
            'no_uf' => 'PARANÁ',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 42,
            'sg_uf' => 'SC',
            'no_uf' => 'SANTA CATARINA',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 43,
            'sg_uf' => 'RS',
            'no_uf' => 'RIO GRANDE DO SUL',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 50,
            'sg_uf' => 'MS',
            'no_uf' => 'MATO GROSSO DO SUL',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 51,
            'sg_uf' => 'MT',
            'no_uf' => 'MATO GROSSO',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 52,
            'sg_uf' => 'GO',
            'no_uf' => 'GOIÁS',
            'created_at' => Carbon::now(),
        ]);
        DB::table('mf.uf')->insert([
            'id_uf' => 53,
            'sg_uf' => 'DF',
            'no_uf' => 'DISTRITO FEDERAL',
            'created_at' => Carbon::now(),
        ]);
    }
}
