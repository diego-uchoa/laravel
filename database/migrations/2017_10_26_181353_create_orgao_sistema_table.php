<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgaoSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.orgao_sistema', function (Blueprint $table) {
            $table->integer('id_orgao')->unsigned();
            $table->foreign('id_orgao')->references('id_orgao')->on('spoa_portal.orgao')->onDelete('cascade');
            $table->integer('id_sistema')->unsigned();
            $table->foreign('id_sistema')->references('id_sistema')->on('spoa_portal.sistema')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal.orgao_sistema', function (Blueprint $table) {
            Schema::drop('spoa_portal.orgao_sistema');
        });
    }
}
