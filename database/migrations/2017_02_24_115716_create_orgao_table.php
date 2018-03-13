<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.orgao', function (Blueprint $table) {
            $table->increments('id_orgao');
            $table->string('sg_orgao', 15);
            $table->string('no_orgao', 200);
            $table->integer('id_municipio')->unsigned();
            $table->foreign('id_municipio')->references('id_municipio')->on('mf.municipio')->on_delete('restrict');
            $table->string('co_uorg', 10)->unique()->nullable();
            $table->boolean('sn_oficial')->default('false');
            $table->integer('nr_ordem')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('spoa_portal.orgao', function (Blueprint $table) {
            $table->integer('id_orgao_id')->unsigned()->nullable();
            $table->foreign('id_orgao_id')->references('id_orgao')->on('spoa_portal.orgao')->on_delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP MATERIALIZED VIEW IF EXISTS spoa_portal.vw_orgao_hierarquia' );
        Schema::dropIfExists('spoa_portal.orgao');
    }
}
