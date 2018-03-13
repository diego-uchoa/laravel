<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.item_menu', function (Blueprint $table) {
            $table->increments('id_item_menu')->unsigned();
            $table->string('no_item_menu', 100);
            $table->string('rota')->nullable();
            $table->integer('ordem')->nullable();
            $table->string('icon')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('id_item_menu_precedente')->unsigned()->nullable();
            $table->integer('id_sistema')->unsigned()->nullable();
            $table->foreign('id_sistema')->references('id_sistema')->on('spoa_portal.sistema')->onDelete('cascade');
            $table->integer('id_operacao')->unsigned()->nullable();
            $table->foreign('id_operacao')->references('id_operacao')->on('spoa_portal.operacao')->onDelete('cascade');
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
        Schema::table('spoa_portal.item_menu', function (Blueprint $table) 
        {
            Schema::drop('spoa_portal.item_menu');
        });
    }
}
