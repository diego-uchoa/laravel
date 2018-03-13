<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTramitacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.tramitacao', function (Blueprint $table) {
            $table->increments('id_tramitacao');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->integer('co_codigo_tramitacao');
            $table->string('sg_casa_tramitacao');
            $table->date('dt_data_tramitacao');
            $table->string('no_orgao_tramitacao')->nullable();
            $table->text('tx_andamento');
            $table->text('tx_observacao')->nullable();
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
        Schema::table('spoa_portal_parla.tramitacao', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.tramitacao');
        });
    }
}
