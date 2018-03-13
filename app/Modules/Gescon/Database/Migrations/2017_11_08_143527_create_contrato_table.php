<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Gescon\Enum\TipoContrato;
use App\Modules\Gescon\Enum\ObjetoContrato;
use App\Modules\Gescon\Enum\TipoVariacao;
use App\Modules\Gescon\Enum\ModalidadeGarantia;
use App\Modules\Gescon\Enum\StatusContrato;

class CreateContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contrato', function (Blueprint $table) {
            $table->increments('id_contrato');
            $table->string('nr_contrato', 8);
            $table->string('co_uasg', 10);
            $table->integer('id_contratante');
            $table->foreign('id_contratante')->references('id_contratante')->on('spoa_portal_gescon.contratante');    
            $table->integer('id_contratante_representante');
            $table->foreign('id_contratante_representante')->references('id_contratante_representante')->on('spoa_portal_gescon.contratante_representante');    
            $table->integer('id_contratante_assinante');
            $table->foreign('id_contratante_assinante')->references('id_contratante_assinante')->on('spoa_portal_gescon.contratante_assinante');    
            $table->enum('in_tipo', TipoContrato::getKeys())->nullable();
            $table->string('nr_modalidade', 8);
            $table->integer('id_modalidade');
            $table->foreign('id_modalidade')->references('id_modalidade')->on('spoa_portal_gescon.modalidade');    
            $table->string('nr_processo', 20);
            $table->string('nr_cronograma', 8)->nullable();
            $table->string('tx_arquivo_modalidade', 255)->nullable();
            $table->string('tx_arquivo_contrato', 255)->nullable();
            $table->string('tx_arquivo_ata', 255)->nullable();
            $table->integer('id_contratada');
            $table->foreign('id_contratada')->references('id_contratada')->on('spoa_portal_gescon.contratada');    
            $table->enum('in_objeto', ObjetoContrato::getKeys())->nullable();
            $table->string('ds_objeto', 255);
            $table->string('ds_informacao_complementar', 500)->nullable();
            $table->decimal('vl_mensal', 10, 2);
            $table->decimal('vl_anual', 10, 2);
            $table->decimal('vl_global', 10, 2);
            $table->date('dt_assinatura');
            $table->date('dt_publicacao');
            $table->date('dt_inicio_servico');
            $table->date('dt_cessacao')->nullable();
            $table->integer('nr_ano_prorrogacao')->nullable();
            $table->date('dt_prorrogacao')->nullable();
            $table->enum('in_tipo_variacao', TipoVariacao::getKeys())->nullable();
            $table->integer('id_indice_variacao')->nullable();
            $table->foreign('id_indice_variacao')->references('id_indice_variacao')->on('spoa_portal_gescon.indice_variacao');    
            $table->enum('in_modalidade_garantia', ModalidadeGarantia::getKeys())->nullable();
            $table->decimal('vl_garantia', 10, 2)->nullable();
            $table->decimal('op_percentual_garantia', 10, 2)->nullable();
            $table->date('dt_vencimento_garantia')->nullable();
            $table->enum('in_status_contrato', StatusContrato::getKeys())->nullable();
            $table->string('ds_justificativa', 255)->nullable();
            $table->date('dt_encerramento')->nullable();
            $table->string('nr_cpf_encerramento', 11)->nullable();
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
        Schema::dropIfExists('spoa_portal_gescon.contrato');
        //DB::statement('DROP TABLE spoa_portal_gescon.contrato CASCADE');
    }
}
