<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrgaoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('spoa_portal.usuario', function(Blueprint $table)
        {
            $table->integer('id_orgao')->unsigned()->nullable();
            $table->foreign('id_orgao')->references('id_orgao')->on('spoa_portal.orgao')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal.usuario', function(Blueprint $table)
        {
            $table->dropColumn('id_orgao');
        });
    }
}


