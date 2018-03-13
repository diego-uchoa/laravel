<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoPrepostoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contrato_preposto', function (Blueprint $table) {
            $table->increments('id_contrato_preposto');
            $table->integer('id_contrato');
            $table->foreign('id_contrato')->references('id_contrato')->on('spoa_portal_gescon.contrato');    
            $table->string('no_preposto', 100);
            $table->string('nr_telefone_preposto', 255);
            $table->string('ds_email_preposto', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spoa_portal_gescon.contrato_preposto');
    }
}
