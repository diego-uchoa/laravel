<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacaoFavoritaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.operacao_favorita', function (Blueprint $table) 
        {
            $table->increments('id_operacao_favorita');
            $table->integer('id_operacao')->unsigned();
            $table->foreign('id_operacao')->references('id_operacao')->on('spoa_portal.operacao')->onDelete('cascade');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('spoa_portal.usuario')->onDelete('cascade');
            $table->integer('id_sistema')->unsigned();
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
        Schema::table('spoa_portal.operacao_favorita', function (Blueprint $table) 
     {
        Schema::drop('spoa_portal.operacao_favorita');
   });
 }
}
