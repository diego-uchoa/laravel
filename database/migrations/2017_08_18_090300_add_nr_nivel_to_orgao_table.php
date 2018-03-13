<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNrNivelToOrgaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('spoa_portal.orgao', function(Blueprint $table)
        {
            $table->integer('nr_nivel')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spoa_portal.orgao', function(Blueprint $table)
        {
            $table->dropColumn('nr_nivel');
        });
    }
}


