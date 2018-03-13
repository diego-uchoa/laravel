<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProposicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spoa_portal_parla.proposicao', function (Blueprint $table) {
            $table->text('sn_terminativo_origem')->nullable()->change();
            $table->text('sn_terminativo_projeto')->nullable()->change();
            $table->renameColumn('sn_terminativo_origem', 'tx_terminativo_origem');
            $table->renameColumn('sn_terminativo_projeto', 'tx_terminativo_projeto');
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
