<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaRelacionadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.materia_relacionada', function (Blueprint $table) {
            $table->increments('id_materia_relacionada');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->string('sg_casa_materia');
            $table->string('no_nome_materia');
            $table->text('tx_link_materia');
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
        Schema::table('spoa_portal_parla.materia_relacionada', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.materia_relacionada');
        });
    }
}
