<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Gescon\Enum\TipoFiscal;

class CreateContratoInformacaoAdicionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contrato_informacao_adicional', function (Blueprint $table) {
            $table->increments('id_contrato_informacao_adicional');
            $table->integer('id_contrato');
            $table->foreign('id_contrato')->references('id_contrato')->on('spoa_portal_gescon.contrato');    
            $table->string('id_campo_informacao_adicional', 100);
            $table->string('ds_campo_informacao_adicional', 255);
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
        Schema::dropIfExists('spoa_portal_gescon.contrato_informacao_adicional');
    }
}
