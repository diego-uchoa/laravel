<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Prisma\Enum\SituacaoInstituicao;

class CreateInstituicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_prisma_s1.instituicao', function (Blueprint $table) {
            $table->increments('id_instituicao');

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
            $table->string('ds_email_responsavel', 100);
            $table->string('nr_telefone_responsavel', 15);
            $table->string('no_cargo_responsavel', 100);

            $table->enum('in_situacao', SituacaoInstituicao::getKeys())->nullable();

            $table->integer('id_solicitacao_cadastro')->unsigned();
            $table->foreign('id_solicitacao_cadastro')->references('id_solicitacao_cadastro')->on('spoa_portal_prisma_s1.solicitacao_cadastro')->onDelete('cascade');

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
        Schema::dropIfExists('spoa_portal_prisma_s1.instituicao');
    }
}
