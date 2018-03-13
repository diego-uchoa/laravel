<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Modules\Sismed\Enum\TipoPericia;
use App\Modules\Sismed\Enum\Situacao;

class CreatePericiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_sismed.pericia', function (Blueprint $table) {
            $table->increments('id_pericia');
            $table->integer('id_atestado')->unsigned()->nullable();
            $table->foreign('id_atestado')->references('id_atestado')->on('spoa_portal_sismed.atestado')->onDelete('cascade');
            $table->integer('te_prazo');
            $table->date('dt_inicio_afastamento');
            $table->date('dt_fim_afastamento');
            $table->string('no_laudo_fisico')->nullable();
            $table->enum('in_situacao',Situacao::getKeys())->default('A');
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
        Schema::table('spoa_portal_sismed.pericia', function (Blueprint $table) {
            Schema::drop('spoa_portal_sismed.pericia');
        });
    }
}
