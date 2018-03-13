<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicaoResponsavelPrevisaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_prisma_s1.instituicao_responsavel_previsao', function (Blueprint $table) {
            $table->increments('id_instituicao_responsavel_previsao');
            $table->string('no_instituicao_responsavel_previsao', 100);
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
        Schema::dropIfExists('spoa_portal_prisma_s1.instituicao_responsavel_previsao');
    }
}
