<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Gescon\Enum\TipoEmpenho;

class CreateContratoProcessoPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contrato_processo_pagamento', function (Blueprint $table) {
            $table->increments('id_contrato_processo_pagamento');
            $table->integer('id_contrato');
            $table->foreign('id_contrato')->references('id_contrato')->on('spoa_portal_gescon.contrato');    
            $table->integer('nr_nota_empenho');
            $table->enum('in_tipo', TipoEmpenho::getKeys())->nullable();
            $table->string('nr_plano_interno', 20)->nullable();
            $table->integer('nr_elemento_despesa')->nullable();
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
        Schema::dropIfExists('spoa_portal_gescon.contrato_processo_pagamento');
    }
}
