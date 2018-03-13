<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Parla\Enum\TipoComissao;

class CreateComissaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.comissao', function (Blueprint $table) {
            $table->increments('id_comissao');
            $table->integer('co_comissao');
            $table->string('sg_casa');
            $table->string('sg_comissao');
            $table->text('no_comissao');
            $table->enum('in_tipo',TipoComissao::getKeys());

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
        Schema::table('spoa_portal_parla.comissao', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.comissao');
        });
    }
}
