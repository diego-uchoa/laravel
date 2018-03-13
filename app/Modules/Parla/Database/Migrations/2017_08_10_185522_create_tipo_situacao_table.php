<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoSituacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.tipo_situacao', function (Blueprint $table) {
            $table->increments('id_tipo_situacao');
            $table->integer('co_tipo_situacao');
            $table->string('tx_tipo_situacao');
            $table->string('sg_casa_situacao');
            $table->string('sg_status_situacao');

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
        Schema::table('spoa_portal_parla.tipo_situacao', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.tipo_situacao');
        });
    }
}
