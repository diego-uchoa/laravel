<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoItemContratacaoTerceirizacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contrato_item_contratacao_terceirizacao', function (Blueprint $table) {
            $table->increments('id_contrato_item_contratacao_terceirizacao');
            $table->integer('id_contrato')->nullable();
            $table->foreign('id_contrato')->references('id_contrato')->on('spoa_portal_gescon.contrato');    
            $table->integer('id_orgao')->nullable();
            $table->foreign('id_orgao')->references('id_orgao')->on('spoa_portal.orgao');    
            $table->integer('id_edificio');
            $table->foreign('id_edificio')->references('id_edificio')->on('spoa_portal_gescon.edificio');    
            $table->integer('id_unidade_medida_item_contratacao');
            $table->foreign('id_unidade_medida_item_contratacao')->references('id_unidade_medida_item_contratacao')->on('spoa_portal_gescon.unidade_medida_item_contratacao');    
            $table->integer('id_tipo_item_contratacao');
            $table->foreign('id_tipo_item_contratacao')->references('id_tipo_item_contratacao')->on('spoa_portal_gescon.tipo_item_contratacao');    
            $table->integer('qt_item_contratacao');
            $table->decimal('vl_item_contratacao', 10, 2);
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
        Schema::dropIfExists('spoa_portal_gescon.contrato_item_contratacao_terceirizacao');
    }
}
