<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAjudaGeralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sishelp.ajuda_geral', function (Blueprint $table) 
        {
            $table->increments('id_ajuda_geral');
            $table->text('tx_ajuda_geral');
            
            $table->integer('id_sistema')->unsigned()->unique();
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
        Schema::table('spoa_portal_sishelp.ajuda_geral', function (Blueprint $table) 
        {
            Schema::drop('spoa_portal_sishelp.ajuda_geral');
        });
    }
}