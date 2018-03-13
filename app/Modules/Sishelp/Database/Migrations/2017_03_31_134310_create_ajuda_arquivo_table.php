<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAjudaArquivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sishelp.ajuda_arquivo', function (Blueprint $table) 
        {
            $table->increments('id_ajuda_arquivo');
            $table->string('no_ajuda_arquivo', 200);
            $table->string('no_ajuda_arquivo_original', 200);
            $table->string('no_ajuda_arquivo_fisico', 200);
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
        Schema::table('spoa_portal_sishelp.ajuda_arquivo', function (Blueprint $table) 
     {
        Schema::drop('spoa_portal_sishelp.ajuda_arquivo');
   });
 }
}
