<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiliacaoPartidaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.filiacao_partidaria', function (Blueprint $table) {
            $table->integer('id_parlamentar');            
                $table->foreign('id_parlamentar')->references('id_parlamentar')->on('spoa_portal_parla.parlamentar');
            $table->string('sg_partido', 10);
            $table->string('no_partido', 100);
            $table->date('dt_filiacao_inicio')->nullable();
            $table->date('dt_filiacao_fim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal_parla.filiacao_partidaria', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.filiacao_partidaria');
        });
    }
}
