<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubstitutivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.substitutivo', function (Blueprint $table) {
            $table->increments('id_substitutivo');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->integer('co_codigo_substitutivo')->unique();
            $table->string('sg_casa_substitutivo');
            $table->string('no_nome_substitutivo');
            $table->text('tx_link_substitutivo');
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
        Schema::table('spoa_portal_parla.substitutivo', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.substitutivo');
        });
    }
}
