<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.emenda', function (Blueprint $table) {
            $table->increments('id_emenda');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->integer('co_codigo_emenda');
            $table->string('sg_casa_emenda');
            $table->string('no_nome_emenda');
            $table->text('tx_link_emenda');
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
        Schema::table('spoa_portal_parla.emenda', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.emenda');
        });
    }
}
