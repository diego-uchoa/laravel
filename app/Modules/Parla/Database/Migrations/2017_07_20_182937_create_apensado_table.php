<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApensadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.apensado', function (Blueprint $table) {
            $table->increments('id_apensado');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->string('sg_casa_apensado');
            $table->string('no_nome_apensado');
            $table->text('tx_link_apensado');
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
        Schema::table('spoa_portal_parla.apensado', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.apensado');
        });
    }
}
