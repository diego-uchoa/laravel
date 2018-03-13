<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeriadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.feriado', function (Blueprint $table) 
        {
            $table->increments('id_feriado');
            $table->date('dt_feriado');
            $table->string('no_feriado', 100);
            $table->boolean('sn_fim_semana')->default('false');

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
        Schema::table('spoa_portal.feriado', function (Blueprint $table) 
     {
        Schema::drop('spoa_portal.feriado');
   });
 }
}
