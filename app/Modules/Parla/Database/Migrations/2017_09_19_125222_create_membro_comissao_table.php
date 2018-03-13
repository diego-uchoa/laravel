<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Parla\Enum\TipoCargo;

class CreateMembroComissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.membro_comissao', function (Blueprint $table) {
            $table->increments('id_membro_comissao');
            $table->integer('id_comissao')->unsigned();
            $table->foreign('id_comissao')->references('id_comissao')->on('spoa_portal_parla.comissao')->onDelete('cascade');
            $table->integer('id_parlamentar')->unsigned();
            $table->foreign('id_parlamentar')->references('id_parlamentar')->on('spoa_portal_parla.parlamentar')->onDelete('cascade');
            $table->enum('in_cargo',TipoCargo::getKeys());          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal_parla.membro_comissao', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.membro_comissao');
        });
    }
}
