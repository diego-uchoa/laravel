<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoTelefoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('spoa_portal_sisfone.tipo_telefone', function (Blueprint $table) {
         $table->increments('id_tipo_telefone');
         $table->string('no_tipo_telefone', 100);
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
     Schema::table('spoa_portal_sisfone.tipo_telefone', function (Blueprint $table) {
      Schema::drop('spoa_portal_sisfone.tipo_telefone');
  });
 }
}
