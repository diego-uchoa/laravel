<?php

use Illuminate\Database\Seeder;
use \App\Modules\Sisadm\Models;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'André Duarte Veras',
            'email' => 'andre.veras@fazenda.gov.br',
            'nr_cpf' => '88958949104',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user2 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'Alan Melo',
            'email' => 'alan.melo@fazenda.gov.br',
            'nr_cpf' => '69378746187',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user3 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'André Boaro',
            'email' => 'andre.boaro@fazenda.gov.br',
            'nr_cpf' => '70822921120',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user4 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'Luisa Palmeira',
            'email' => 'luisa.palmeira@fazenda.gov.br',
            'nr_cpf' => '03391664100',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user5 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'DANIELE CAVALARI CAVALCANTE',
            'email' => 'daniele.cavalcante@fazenda.gov.br',
            'nr_cpf' => '05250001602',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user6 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'TATYANE SOARES MARQUES DE SOUZA',
            'email' => 'tatyane.marques@fazenda.gov.br',
            'nr_cpf' => '01092971130',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user7 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'ELI RODRIGUES DE OLIVEIRA',
            'email' => 'eli.oliveira@fazenda.gov.br',
            'nr_cpf' => '01368013821',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);
        
        $user8 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'OLIVAL ARRUDA PEREIRA',
            'email' => 'olival.pereira@fazenda.gov.br',
            'nr_cpf' => '21015252168',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user9 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'REGINA DELCHO DE SOUZA',
            'email' => 'regina.delcho@fazenda.gov.br',
            'nr_cpf' => '33952400106',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user10 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'RITA GLAUCILENE PIMENTA DE PADUA',
            'email' => 'rita.padua@fazenda.gov.br',
            'nr_cpf' => '24523500100',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user11 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'MARCOS ALVES DE OLIVEIRA',
            'email' => 'marcos.alves.oliveira@fazenda.gov.br',
            'nr_cpf' => '01218398183',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);

        $user12 = factory(\App\Modules\Sisadm\Models\User::class)->create([
            'no_usuario' => 'GLÁUCIA DE OLIVEIRA DIAS',
            'email' => 'glaucia.dias@fazenda.gov.br',
            'nr_cpf' => '76551121187',
            'password' => bcrypt(123456),
            'id_orgao' => 7,
            'sn_ldap' => false
        ]);
    }
}
