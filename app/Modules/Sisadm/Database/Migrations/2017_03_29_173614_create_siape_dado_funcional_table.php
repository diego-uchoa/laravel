<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Sisadm\Models\SiapeDadoFuncional;

class CreateSiapeDadoFuncionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.siape_dado_funcional', function (Blueprint $table) {
            $table->string('nr_cpf');
            $table->string('co_uorg_exercicio', 10)->nullable();
            $table->string('co_uorg_lotacao', 10)->nullable();
            $table->string('co_upag', 14)->nullable();
            $table->string('co_funcao', 20)->nullable();
            $table->date('dt_ingresso_funcao')->nullable();
            $table->date('dt_ocorrencia_exclusao')->nullable();
            $table->string('ds_ocorrencia_exclusao')->nullable();
            $table->string('nr_cpf_chefia')->nullable();
            $table->date('dt_ingresso_orgao');
            $table->string('nr_siape')->unique();
            $table->primary(['nr_cpf','nr_siape']);
            $table->integer('co_cargo')->nullable();
            $table->foreign('co_cargo')->references('co_cargo')->on('spoa_portal.siape_cargo')->onDelete('set null');
            $table->string('co_situacao_funcional')->nullable();
            $table->foreign('co_situacao_funcional')->references('co_situacao_funcional')->on('spoa_portal.siape_situacao_funcional')->onDelete('cascade');
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
        Schema::table('spoa_portal.siape_dado_funcional', function (Blueprint $table) {
            Schema::drop('spoa_portal.siape_dado_funcional');
        });
    }
}
