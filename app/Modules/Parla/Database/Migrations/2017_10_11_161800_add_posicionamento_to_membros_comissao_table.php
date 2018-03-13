<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Parla\Enum\TipoPosicionamento;

class AddPosicionamentoToMembrosComissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spoa_portal_parla.membro_comissao', function (Blueprint $table) {
            $table->enum('in_posicionamento_comissao',TipoPosicionamento::getKeys())->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
