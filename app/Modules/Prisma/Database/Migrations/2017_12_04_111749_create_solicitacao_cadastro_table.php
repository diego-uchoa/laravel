<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Prisma\Enum\SituacaoSolicitacao;

class CreateSolicitacaoCadastroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_prisma_s1.solicitacao_cadastro', function (Blueprint $table) {
            $table->increments('id_solicitacao_cadastro');
            $table->string('nr_cnpj', 18)->unique();
            $table->string('no_razao_social', 200);
            $table->string('no_fantasia', 200);
            $table->string('no_situacao', 100);
            $table->string('nr_telefone', 50);
            $table->string('ds_email', 100);
            $table->string('ed_cep_logradouro', 10)->nullable();
            $table->string('ed_logradouro', 255);
            $table->string('ed_numero_logradouro')->nullable();
            $table->string('ed_complemento_logradouro', 255)->nullable();
            $table->string('ed_bairro_logradouro', 200)->nullable();
            $table->string('ed_municipio_logradouro', 200)->nullable();
            $table->string('ed_sigla_uf', 2)->nullable();
            
            $table->string('nr_cpf_responsavel', 11);
            $table->string('no_responsavel', 200);
            $table->string('nr_telefone_responsavel', 15);
            $table->string('ds_email_responsavel', 100);
            $table->string('no_cargo_responsavel', 100);
            
            $table->enum('in_situacao_solicitacao',SituacaoSolicitacao::getKeys());
            $table->date('dt_analise')->nullable();
            $table->text('tx_analise')->nullable();

            $table->integer('id_usuario_analise')->unsigned()->nullable();
            $table->foreign('id_usuario_analise')->references('id_usuario')->on('spoa_portal.usuario');

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
        Schema::dropIfExists('spoa_portal_prisma_s1.solicitacao_cadastro');
    }
}
