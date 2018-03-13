<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Modules\Sismed\Enum\Situacao;
use App\Modules\Sismed\Enum\AreaAtendimento;
use App\Modules\Sismed\Enum\TipoAfastamento;
use App\Modules\Sismed\Enum\TipoPericia;

class CreateAtestadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sismed.atestado', function (Blueprint $table) {
            $table->increments('id_atestado');
            $table->integer('id_servidor')->unsigned()->nullable();
            $table->foreign('id_servidor')->references('id_servidor')->on('spoa_portal_sismed.servidor')->onDelete('cascade');
            $table->integer('te_prazo');
            $table->integer('nr_crm')->nullable();
            $table->string('no_medico')->nullable();
            $table->date('dt_inicio_afastamento');
            $table->date('dt_fim_afastamento');
            $table->string('no_atestado_fisico')->nullable();
            $table->string('no_laudo_fisico')->nullable();
            $table->text('tx_justificativa_exclusao')->nullable();
            $table->text('tx_observacao')->nullable();
            $table->enum('in_situacao',Situacao::getKeys())->default('A');
            $table->enum('in_area_atendimento',AreaAtendimento::getKeys())->default('M');
            $table->enum('in_tipo_afastamento',TipoAfastamento::getKeys())->default('P');
            $table->enum('in_tipo_pericia',TipoPericia::getKeys())->default('S');

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
        Schema::table('spoa_portal_sismed.atestado', function (Blueprint $table) {
            //Schema::drop('spoa_portal_sismed.pericia');
            Schema::drop('spoa_portal_sismed.atestado');
        });
    }
}
