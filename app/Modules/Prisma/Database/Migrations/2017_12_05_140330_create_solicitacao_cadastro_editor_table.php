<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaoCadastroEditorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_prisma_s1.solicitacao_cadastro_editor', function (Blueprint $table) {
            $table->increments('id_solicitacao_cadastro_editor');
            $table->string('nr_cpf', 11);
            $table->string('no_editor', 200);
            $table->string('ds_email', 100);
            $table->string('nr_telefone', 15);
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
        Schema::dropIfExists('spoa_portal_prisma_s1.solicitacao_cadastro_editor');
    }
}
