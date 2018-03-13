<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoPosicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.tipo_posicao', function (Blueprint $table) {
            $table->increments('id_tipo_posicao');
            $table->string('tx_tipo_posicao');

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
        Schema::table('spoa_portal_parla.tipo_posicao', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.tipo_posicao');
        });
    }
}
