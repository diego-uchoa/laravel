<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('spoa_portal.aviso_sistema', function (Blueprint $table) 
       {
          $table->increments('id_aviso_sistema');
          $table->string('tx_aviso_sistema', 500);
          $table->integer('nr_ordem')->nullable();
          $table->timestamp('dt_aviso_sistema')->nullable();
          $table->boolean('sn_destaque')->default('false');

          $table->integer('id_tipo_aviso_sistema')->unsigned()->nullable();
          $table->foreign('id_tipo_aviso_sistema')->references('id_tipo_aviso_sistema')->on('spoa_portal.tipo_aviso_sistema')->onDelete('cascade');

          $table->integer('id_sistema')->unsigned()->nullable();
          $table->foreign('id_sistema')->references('id_sistema')->on('spoa_portal.sistema')->onDelete('cascade');
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
     Schema::table('spoa_portal.aviso_sistema', function (Blueprint $table) 
     {
      Schema::drop('spoa_portal.aviso_sistema');
  });
 }
}
