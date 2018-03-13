<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInconsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('spoa_portal.inconsistencia', function (Blueprint $table) 
              {
                  $table->increments('id_inconsistencia');
                  $table->string('tx_inconsistencia', 100);
                  $table->string('no_campo', 100);
                  $table->string('no_tabela', 100);
                  $table->string('tx_tipo_campo', 100);
                  $table->string('no_usuario', 100);
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
        Schema::table('spoa_portal.inconsistencia', function (Blueprint $table) 
        {
               Schema::drop('spoa_portal.inconsistencia');
        });
    }
}
