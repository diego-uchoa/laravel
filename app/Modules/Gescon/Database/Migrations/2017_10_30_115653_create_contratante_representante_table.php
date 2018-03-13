<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratanteRepresentanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contratante_representante', function (Blueprint $table) {
            $table->increments('id_contratante_representante');
            $table->integer('id_contratante');
            $table->foreign('id_contratante')->references('id_contratante')->on('spoa_portal_gescon.contratante')->onDelete('cascade');    
            $table->string('nr_cpf_representante', 14);
            $table->string('no_representante', 255);
            $table->string('ds_funcao_representante', 100)->nullable();
            $table->string('nr_rg_representante', 15)->nullable();
            $table->date('dt_inicio');
            $table->date('dt_fim')->nullable();
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
        Schema::dropIfExists('spoa_portal_gescon.contratante_representante');
    }
}
