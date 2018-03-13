<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Sismed\Enum\RegimeJuridico;
use App\Modules\Sismed\Enum\SituacaoServidor;

class CreateServidorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sismed.servidor', function (Blueprint $table) {
            $table->increments('id_servidor');
            $table->string('nr_cpf')->unique();
            $table->string('ds_email')->nullable();
            $table->string('no_servidor');
            $table->date('dt_nascimento')->nullable();
            $table->string('in_sexo', 1)->nullable();
            $table->string('tx_telefone_unidade',25)->nullable();
            $table->string('tx_telefone_celular',25)->nullable();
            $table->string('tx_telefone_residencial',25)->nullable();
            $table->string('nr_siape')->nullable();
            $table->string('nr_rg')->nullable();
            $table->string('no_orgao')->nullable();
            $table->string('no_cargo', 100)->nullable();
            $table->string('no_unidade_lotacao', 100)->nullable();
            $table->string('no_unidade_exercicio', 100)->nullable();
            $table->string('co_prontuario', 10);
            $table->enum('in_regime_juridico',RegimeJuridico::getKeys())->default('EST')->nullable();
            $table->enum('in_situacao_servidor',SituacaoServidor::getKeys())->default('A')->nullable();
            $table->string('tx_local_arquivo_geral')->nullable();
            
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
        Schema::table('spoa_portal_sismed.servidor', function (Blueprint $table) {
            Schema::drop('spoa_portal_sismed.servidor');
        });
    }
}
