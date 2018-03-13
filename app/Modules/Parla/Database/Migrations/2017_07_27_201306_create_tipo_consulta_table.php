<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.tipo_consulta', function (Blueprint $table) {
            $table->increments('id_tipo_consulta');
            $table->string('tx_tipo_consulta');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal_parla.tipo_consulta', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.tipo_consulta');
        });
    }
}
