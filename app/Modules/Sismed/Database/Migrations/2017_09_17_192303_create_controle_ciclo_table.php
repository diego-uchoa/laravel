<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControleCicloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sismed.controle_ciclo', function (Blueprint $table) {
            $table->increments('id_controle_ciclo');
            $table->integer('id_servidor')->unsigned()->nullable();
            $table->foreign('id_servidor')->references('id_servidor')->on('spoa_portal_sismed.servidor')->onDelete('cascade');
            $table->integer('id_atestado_origem')->unsigned()->nullable();
            $table->foreign('id_atestado_origem')->references('id_atestado')->on('spoa_portal_sismed.atestado')->onDelete('SET NULL');
            $table->date('dt_inicio_ciclo');
            $table->date('dt_fim_ciclo');
            $table->integer('va_adicional_ciclo_anterior')->nullable();
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
        Schema::drop('spoa_portal_sismed.controle_ciclo');
    }
}
