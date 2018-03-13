<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.fiscal', function (Blueprint $table) {
            $table->increments('id_fiscal');
            $table->string('nr_cpf', 11);
            $table->string('no_fiscal', 100);
            $table->string('nr_siape', 7)->unique();
            $table->string('ds_email', 100);
            $table->string('nr_telefone', 16)->nullable();
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
        Schema::dropIfExists('spoa_portal_gescon.fiscal');
    }
}
