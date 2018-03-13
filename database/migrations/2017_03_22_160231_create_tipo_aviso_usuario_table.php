<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoAvisoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('spoa_portal.tipo_aviso_usuario', function (Blueprint $table) {
         $table->increments('id_tipo_aviso_usuario');
         $table->string('no_tipo_aviso_usuario', 100);
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
     Schema::table('spoa_portal.tipo_aviso_usuario', function (Blueprint $table) {
      Schema::drop('spoa_portal.tipo_aviso_usuario');
  });
 }
}
