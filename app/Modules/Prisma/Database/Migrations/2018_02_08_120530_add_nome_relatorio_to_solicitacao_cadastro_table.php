<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNomeRelatorioToSolicitacaoCadastroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spoa_portal_prisma_s1.solicitacao_cadastro', function(Blueprint $table)
        {
            $table->string('no_relatorio', 200)->nullable();
            $table->integer('id_instituicao_responsavel_previsao')->unsigned()->nullable();
            $table->foreign('id_instituicao_responsavel_previsao')->references('id_instituicao_responsavel_previsao')->on('spoa_portal_prisma_s1.instituicao_responsavel_previsao');
            $table->dropColumn('no_fantasia');
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
