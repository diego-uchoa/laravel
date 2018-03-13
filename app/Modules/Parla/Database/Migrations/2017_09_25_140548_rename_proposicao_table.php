<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameProposicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spoa_portal_parla.proposicao', function (Blueprint $table) {
            $table->renameColumn('sn_possui_projeto', 'sn_possui_revisora');
            $table->renameColumn('co_codigo_projeto', 'co_codigo_revisora');
            $table->renameColumn('sg_sigla_projeto', 'sg_sigla_revisora');
            $table->renameColumn('nr_numero_projeto', 'nr_numero_revisora');
            $table->renameColumn('an_ano_projeto', 'an_ano_revisora');
            $table->renameColumn('sg_casa_projeto', 'sg_casa_revisora');
            $table->renameColumn('tx_link_projeto', 'tx_link_revisora');
            $table->renameColumn('tx_terminativo_projeto', 'tx_terminativo_revisora');
            $table->renameColumn('in_regime_tramitacao_projeto', 'in_regime_tramitacao_revisora');
            $table->renameColumn('in_situacao_projeto', 'in_situacao_revisora');
            $table->renameColumn('tx_situacao_projeto', 'tx_situacao_revisora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
