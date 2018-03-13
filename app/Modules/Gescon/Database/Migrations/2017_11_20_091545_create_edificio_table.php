<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdificioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.edificio', function (Blueprint $table) {
            $table->increments('id_edificio');
            $table->string('co_edificio', 6);
            $table->string('no_edificio', 60);
            $table->string('sg_uf', 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spoa_portal_gescon.edificio');
    }
}
