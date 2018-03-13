<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Sisadm\Models\SiapeCargo;

class CreateSiapeCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.siape_cargo', function (Blueprint $table) {
            $table->integer('co_cargo')->unique();
            $table->primary('co_cargo');
            $table->string('no_cargo');
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
        Schema::table('spoa_portal.siape_cargo', function (Blueprint $table) {
            Schema::drop('spoa_portal.siape_cargo');
        });
    }
}
