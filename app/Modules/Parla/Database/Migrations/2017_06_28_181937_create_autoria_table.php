<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Parla\Enum\TipoAutor;

class CreateAutoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_parla.autoria', function (Blueprint $table) {
            $table->increments('id_autoria');
            $table->integer('id_proposicao')->unsigned();
            $table->foreign('id_proposicao')->references('id_proposicao')->on('spoa_portal_parla.proposicao')->onDelete('cascade');
            $table->integer('id_parlamentar')->unsigned()->nullable();
            $table->foreign('id_parlamentar')->references('id_parlamentar')->on('spoa_portal_parla.parlamentar')->onDelete('cascade');
            $table->string('no_nome_autor');
            $table->enum('in_tipo_autor',TipoAutor::getKeys());
            $table->string('sg_partido_autor')->nullable();
            $table->string('sg_uf_autor')->nullable();
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
        Schema::table('spoa_portal_parla.autoria', function (Blueprint $table) {
            Schema::drop('spoa_portal_parla.autoria');
        });
    }
}
