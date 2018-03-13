<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.usuario_perfil', function (Blueprint $table) {
            $table->integer('id_perfil')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_perfil')->references('id_perfil')->on('spoa_portal.perfil')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('spoa_portal.usuario')->onDelete('cascade');
            $table->primary(['id_perfil','id_usuario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal.usuario_perfil', function (Blueprint $table) {
            Schema::drop('spoa_portal.usuario_perfil');
        });
    }
}
