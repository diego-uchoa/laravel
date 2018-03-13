<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.usuario', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('no_usuario');
            $table->string('nr_cpf', 11)->unique();
            $table->string('email')->nullable();
            $table->boolean('sn_ldap')->default('true')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal.usuario', function (Blueprint $table) {
            Schema::drop('spoa_portal.usuario');
        });
    }
}
