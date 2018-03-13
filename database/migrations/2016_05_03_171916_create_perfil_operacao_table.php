<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilOperacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        * Adaptação para utilizar o pacote Zizaco/Entruts
        */
        /*Schema::create('spoa_portal.perfil_operacao', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')->references('id_operacao')->on('operacao')->onDelete('cascade');
            $table->foreign('role_id')->references('id_perfil')->on('perfil')->onDelete('cascade');
            $table->primary(['permission_id','role_id']);
        });*/

        
        Schema::create('spoa_portal.perfil_operacao', function (Blueprint $table) {
            $table->integer('operacao_id_operacao')->unsigned();
            $table->integer('perfil_id_perfil')->unsigned();
            $table->foreign('operacao_id_operacao')->references('id_operacao')->on('spoa_portal.operacao')->onDelete('cascade');
            $table->foreign('perfil_id_perfil')->references('id_perfil')->on('spoa_portal.perfil')->onDelete('cascade');
            $table->primary(['operacao_id_operacao','perfil_id_perfil']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal.perfil_operacao', function (Blueprint $table) {
            Schema::drop('spoa_portal.perfil_operacao');
        });
    }
}
