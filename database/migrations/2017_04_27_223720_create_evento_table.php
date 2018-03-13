<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('spoa_portal.evento', function(Blueprint $table) {
                $table->increments('id_evento');
                $table->string('no_evento');
                $table->string('ds_evento')->nullable();
                $table->datetime('dt_inicio');
                $table->datetime('dt_fim');
                $table->boolean('sn_todo_dia')->default(false)->nullable();
                $table->string('tx_cor')->nullable();
                $table->timestamps();
                $table->integer('id_usuario')->unsigned();
                $table->foreign('id_usuario')->references('id_usuario')->on('spoa_portal.usuario')->onDelete('cascade');                
            });
        }
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::drop('spoa_portal.evento');
        }

}
