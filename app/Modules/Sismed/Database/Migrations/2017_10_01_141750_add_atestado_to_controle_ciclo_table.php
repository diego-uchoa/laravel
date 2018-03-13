<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAtestadoToControleCicloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spoa_portal_sismed.atestado', function(Blueprint $table)
        {
            $table->integer('id_controle_ciclo')->unsigned()->nullable();
            $table->foreign('id_controle_ciclo')->references('id_controle_ciclo')->on('spoa_portal_sismed.controle_ciclo');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal_sismed.atestado', function(Blueprint $table)
        {
            $table->dropColumn('id_controle_ciclo');
        });
    }
}
