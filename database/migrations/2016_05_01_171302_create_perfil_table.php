<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.perfil', function (Blueprint $table) {
            $table->increments('id_perfil');
            $table->string('no_perfil', 100)->unique();
            $table->string('ds_perfil', 255)->nullable();
            $table->integer('id_sistema')->unsigned()->nullable();
            $table->foreign('id_sistema')->references('id_sistema')->on('spoa_portal.sistema')->onDelete('set null');
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
        Schema::table('spoa_portal.perfil', function (Blueprint $table) {
            Schema::drop('spoa_portal.perfil');
        });
    }
}
