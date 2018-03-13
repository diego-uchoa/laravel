<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Gescon\Enum\TipoFiscal;

class CreateContratoFiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contrato_fiscal', function (Blueprint $table) {
            $table->increments('id_contrato_fiscal');
            $table->integer('id_contrato');
            $table->foreign('id_contrato')->references('id_contrato')->on('spoa_portal_gescon.contrato');    
            $table->integer('id_fiscal_titular');
            $table->foreign('id_fiscal_titular')->references('id_fiscal')->on('spoa_portal_gescon.fiscal');    
            $table->integer('id_fiscal_substituto')->nullable();
            $table->foreign('id_fiscal_substituto')->references('id_fiscal')->on('spoa_portal_gescon.fiscal');    
            $table->enum('in_tipo', TipoFiscal::getKeys())->nullable();
            $table->string('nr_portaria', 8);
            $table->date('dt_execucao');
            $table->string('nr_boletim', 8);
            $table->string('tx_arquivo_ebps', 255)->nullable();
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
        Schema::dropIfExists('spoa_portal_gescon.contrato_fiscal');
    }
}
