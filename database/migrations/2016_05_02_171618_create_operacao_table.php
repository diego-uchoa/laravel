<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.operacao', function (Blueprint $table) 
        {
            $table->increments('id_operacao');
            $table->string('no_operacao', 100)->unique();
            $table->string('ds_operacao', 255)->nullable();
            $table->boolean('sn_favorita')->default('false')->nullable();
            $table->integer('id_sistema')->unsigned()->nullable();
            $table->foreign('id_sistema')->references('id_sistema')->on('spoa_portal.sistema')->onDelete('cascade');
                        
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
        Schema::table('spoa_portal.operacao', function (Blueprint $table) 
        {
            Schema::drop('spoa_portal.operacao');
        });
    }
}
