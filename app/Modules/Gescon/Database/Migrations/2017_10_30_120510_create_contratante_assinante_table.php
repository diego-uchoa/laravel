<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratanteAssinanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contratante_assinante', function (Blueprint $table) {
            $table->increments('id_contratante_assinante');
            $table->integer('id_contratante');
            $table->foreign('id_contratante')->references('id_contratante')->on('spoa_portal_gescon.contratante')->onDelete('cascade');    
            $table->string('nr_cpf_assinante', 14);
            $table->string('no_assinante', 255);
            $table->string('ds_funcao_assinante', 100)->nullable();
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
        Schema::dropIfExists('spoa_portal_gescon.contratante_assinante');
    }
}
