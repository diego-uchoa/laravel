<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Parla\Enum\RegimeTramitacao;
use App\Modules\Parla\Enum\Situacao;

class CreateProposicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.proposicao', function (Blueprint $table) {
            $table->increments('id_proposicao');
            $table->integer('co_codigo_origem');
            $table->string('sg_sigla_origem');
            $table->integer('nr_numero_origem');
            $table->integer('an_ano_origem');
            $table->string('sg_casa_origem');
            $table->text('tx_link_origem');
            $table->boolean('sn_terminativo_origem')->nullable();
            $table->enum('in_regime_tramitacao_origem',RegimeTramitacao::getKeys())->nullable();
            $table->enum('in_situacao_origem',Situacao::getKeys());
            $table->text('tx_situacao_origem');
            $table->boolean('sn_possui_projeto')->default(0);
            $table->integer('co_codigo_projeto')->nullable();
            $table->string('sg_sigla_projeto')->nullable();
            $table->integer('nr_numero_projeto')->nullable();
            $table->integer('an_ano_projeto')->nullable();
            $table->string('sg_casa_projeto')->nullable();
            $table->text('tx_link_projeto')->nullable();
            $table->boolean('sn_terminativo_projeto')->nullable();
            $table->enum('in_regime_tramitacao_projeto',RegimeTramitacao::getKeys())->nullable();
            $table->enum('in_situacao_projeto',Situacao::getKeys())->nullable();
            $table->text('tx_situacao_projeto')->nullable();
            $table->text('tx_ementa');
            $table->text('tx_palavra_chave');       
            $table->integer('nr_prioritario')->default(3);
            $table->string('tx_norma_gerada')->nullable();
            $table->text('tx_observacao')->nullable();
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
        Schema::table('spoa_portal_parla.proposicao', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.proposicao');
        });
    }
}
