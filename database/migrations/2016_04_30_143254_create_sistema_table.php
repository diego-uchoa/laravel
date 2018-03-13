<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.sistema', function (Blueprint $table) {
            $table->increments('id_sistema');
            $table->string('no_sistema', 100)->unique();
            $table->string('ds_sistema', 255)->nullable();
            $table->string('tx_beneficio', 255)->nullable();
            $table->string('tx_publico', 255)->nullable();
            $table->string('co_esquema', 255);
            $table->boolean('sn_ativo')->default(true);
            $table->boolean('sn_tela_inicial')->default(true);
            $table->string('no_responsavel', 255)->nullable();
            $table->string('tx_email_responsavel', 255)->nullable();
            $table->string('nr_ordem')->nullable();
            $table->integer('id_area')->unsigned()->nullable();
            $table->foreign('id_area')->references('id_area')->on('spoa_portal.area')->onDelete('cascade');
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
        Schema::table('spoa_portal.sistema', function (Blueprint $table) {
            Schema::drop('spoa_portal.sistema');
        });
    }
}
