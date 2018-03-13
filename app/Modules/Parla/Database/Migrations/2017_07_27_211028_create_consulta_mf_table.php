<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaMfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.consulta_mf', function (Blueprint $table) {
            $table->increments('id_consulta_mf');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->integer('id_orgao')->unsigned();
            $table->foreign('id_orgao')->references('id_orgao')->on('spoa_portal.orgao');
            $table->integer('id_tipo_consulta')->unsigned();
            $table->foreign('id_tipo_consulta')->references('id_tipo_consulta')->on('spoa_portal_parla.tipo_consulta')->onDelete('cascade');
            $table->integer('id_tipo_posicao')->nullable()->unsigned();
            $table->foreign('id_tipo_posicao')->references('id_tipo_posicao')->on('spoa_portal_parla.tipo_posicao')->onDelete('cascade');
            $table->date('dt_envio');
            $table->date('dt_retorno')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal_parla.consulta_mf', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.consulta_mf');
        });
    }
}
