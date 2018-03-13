<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Gescon\Enum\ObjetoContrato;

class CreateUnidadeMedidaItemContratacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.unidade_medida_item_contratacao', function (Blueprint $table) {
            $table->increments('id_unidade_medida_item_contratacao');
            $table->enum('in_objeto', ObjetoContrato::getKeys())->nullable();
            $table->string('ds_unidade_medida_item_contratacao', 100);
            $table->string('sg_unidade_medida_item_contratacao', 10);
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
        Schema::dropIfExists('spoa_portal_gescon.unidade_medida_item_contratacao');
    }
}
