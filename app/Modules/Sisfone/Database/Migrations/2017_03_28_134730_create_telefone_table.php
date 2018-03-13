<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('spoa_portal_sisfone.telefone', function (Blueprint $table) 
       {
          $table->increments('id_telefone');
          $table->string('tx_telefone', 20);
          $table->boolean('sn_principal')->default(false)->nullable();
          
          $table->integer('id_tipo_telefone')->unsigned()->nullable();
          $table->foreign('id_tipo_telefone')->references('id_tipo_telefone')->on('spoa_portal_sisfone.tipo_telefone')->onDelete('cascade');

          $table->integer('id_usuario')->unsigned();
          $table->foreign('id_usuario')->references('id_usuario')->on('spoa_portal.usuario')->onDelete('cascade');
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
     Schema::table('spoa_portal_sisfone.telefone', function (Blueprint $table) 
     {
      Schema::drop('spoa_portal_sisfone.telefone');
  });
 }
}
