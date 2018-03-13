<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAjudaFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sishelp.ajuda_faq', function (Blueprint $table) 
        {
            $table->increments('id_ajuda_faq');
            $table->string('tx_pergunta', 500);
            $table->string('tx_resposta', 500);
           
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
        Schema::table('spoa_portal_sishelp.ajuda_faq', function (Blueprint $table) 
     {
        Schema::drop('spoa_portal_sishelp.ajuda_faq');
   });
 }
}

