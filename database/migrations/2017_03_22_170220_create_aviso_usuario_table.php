<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('spoa_portal.aviso_usuario', function (Blueprint $table) 
       {
          $table->increments('id_aviso_usuario');
          $table->string('tx_aviso_usuario', 500);
          $table->integer('nr_ordem')->nullable();
          $table->timestamp('dt_aviso_usuario')->nullable();
          $table->boolean('sn_lido')->default('false');
          $table->timestamp('dt_lido')->nullable();

          $table->integer('id_tipo_aviso_usuario')->unsigned()->nullable();
          $table->foreign('id_tipo_aviso_usuario')->references('id_tipo_aviso_usuario')->on('spoa_portal.tipo_aviso_usuario')->onDelete('cascade');

          $table->integer('id_usuario')->unsigned();
          $table->foreign('id_usuario')->references('id_usuario')->on('spoa_portal.usuario')->onDelete('cascade');

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
     Schema::table('spoa_portal.aviso_usuario', function (Blueprint $table) 
     {
      Schema::drop('spoa_portal.aviso_usuario');
  });
 }
}
