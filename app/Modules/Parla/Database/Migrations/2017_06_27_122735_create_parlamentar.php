<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParlamentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.parlamentar', function (Blueprint $table) {
            $table->increments('id_parlamentar');
            $table->integer('co_parlamentar');            
            $table->string('no_parlamentar', 150);
            $table->string('no_civil', 200);
            $table->enum('in_sexo', ['M', 'F']);
            $table->enum('in_cargo', ['DEP', 'SEN']);
            $table->date('dt_nascimento')->nullable();
            $table->char('sg_uf_parlamentar', 2)->nullable();
            $table->string('ds_email', 200)->nullable();
            $table->boolean('sn_exercicio')->default(false);
            $table->string('aq_foto')->nullable();
            $table->date('dt_cadastro_fim')->nullable();
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
        Schema::table('spoa_portal_parla.parlamentar', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.parlamentar');
        });
    }
}