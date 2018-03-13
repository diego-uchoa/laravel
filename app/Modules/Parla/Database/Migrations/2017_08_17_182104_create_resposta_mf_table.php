<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostaMfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.resposta_mf', function (Blueprint $table) {
            $table->increments('id_resposta_mf');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->date('dt_envio');
            $table->integer('id_tipo_posicao')->nullable()->unsigned();
            $table->foreign('id_tipo_posicao')->references('id_tipo_posicao')->on('spoa_portal_parla.tipo_posicao')->onDelete('cascade');
            $table->integer('id_orgao')->unsigned();
            $table->foreign('id_orgao')->references('id_orgao')->on('spoa_portal.orgao');
            $table->string('no_documento');
            $table->string('tx_arquivo')->nullable();
            $table->text('tx_descricao')->nullable();

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
        Schema::table('spoa_portal_parla.resposta_mf', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.resposta_mf');
        });
    }
}
