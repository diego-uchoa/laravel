<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mf.municipio', function (Blueprint $table) {
            $table->increments('id_municipio');
            $table->string('no_municipio', 100);
            $table->string('co_municipio_ibge',10)->unique()->nullable();
            $table->string('co_municipio_siorg',10)->unique()->nullable();
            $table->integer('id_uf')->unsigned();
            $table->foreign('id_uf')->references('id_uf')->on('mf.uf')->on_delete('restrict');
            $table->softDeletes();
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
        Schema::dropIfExists('mf.municipio');
    }
}
