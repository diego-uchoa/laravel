<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Sisadm\Models\SiapeSituacaoFuncional;

class CreateSiapeSituacaoFuncionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.siape_situacao_funcional', function (Blueprint $table) {
            $table->string('co_situacao_funcional')->unique();
            $table->primary('co_situacao_funcional');
            $table->string('no_situacao_funcional');
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
        Schema::table('spoa_portal.siape_situacao_funcional', function (Blueprint $table) {
            Schema::drop('spoa_portal.siape_situacao_funcional');
        });
    }
}
