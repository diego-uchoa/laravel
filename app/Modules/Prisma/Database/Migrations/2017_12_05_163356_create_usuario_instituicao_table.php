<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioInstituicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_prisma_s1.usuario_instituicao', function (Blueprint $table) {
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id_usuario')->on('spoa_portal.usuario');
            
            $table->integer('id_instituicao')->unsigned();
            $table->foreign('id_instituicao')->references('id_instituicao')->on('spoa_portal_prisma_s1.instituicao')->onDelete('cascade');
            
            $table->string('nr_telefone', 15);

            $table->primary(['id_usuario','id_instituicao']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spoa_portal_prisma_s1.usuario_instituicao');
    }
}
