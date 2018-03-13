<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratanteUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contratante_usuario', function (Blueprint $table) {
            $table->increments('id_contratante_usuario');
            $table->integer('id_contratante');
            $table->foreign('id_contratante')->references('id_contratante')->on('spoa_portal_gescon.contratante')->onDelete('cascade');    
            $table->integer('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('spoa_portal.usuario');    
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
        Schema::dropIfExists('spoa_portal_gescon.contratante_usuario');
    }
}
