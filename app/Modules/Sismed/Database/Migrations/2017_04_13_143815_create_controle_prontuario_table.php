<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControleProntuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sismed.controle_prontuario', function (Blueprint $table) {
            $table->integer('nr_prontuario');
            $table->string('in_letra_prontuario',1)->unique();
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
        Schema::table('spoa_portal_sismed.controle_prontuario', function (Blueprint $table) {
            Schema::drop('spoa_portal_sismed.controle_prontuario');
        });
    }
}
