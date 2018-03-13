<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoSiafiToOrgaoTable extends Migration
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
            $table->integer('co_siafi')->unsigned()->nullable();
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
            $table->dropColumn('co_siafi');
        });
    }
}


