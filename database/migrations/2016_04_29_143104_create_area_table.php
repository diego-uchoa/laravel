<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.area', function (Blueprint $table) {
            $table->increments('id_area');
            $table->string('no_area');
            $table->string('ds_area')->nullable();
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
        Schema::table('spoa_portal.area', function (Blueprint $table) {
            Schema::drop('spoa_portal.area');
        });
    }
}
