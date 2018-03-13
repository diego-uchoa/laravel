<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoAvisoSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('spoa_portal.tipo_aviso_sistema', function (Blueprint $table) {
         $table->increments('id_tipo_aviso_sistema');
         $table->string('no_tipo_aviso_sistema', 100);
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
     Schema::table('spoa_portal.tipo_aviso_sistema', function (Blueprint $table) {
      Schema::drop('spoa_portal.tipo_aviso_sistema');
  });
 }
}
