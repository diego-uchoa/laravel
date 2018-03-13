<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Gescon\Enum\TipoContratada;

class CreateContratadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal_gescon.contratada', function (Blueprint $table) {
            $table->increments('id_contratada');
            $table->enum('in_tipo_contratada',TipoContratada::getKeys());
            $table->string('nr_cpf_cnpj', 14)->unique();
            $table->string('no_razao_social', 200);
            $table->string('ed_cep_logradouro', 10);
            $table->string('ed_logradouro', 255);
            $table->string('ed_numero_logradouro', 10)->nullable();
            $table->string('ed_complemento_logradouro', 255)->nullable();
            $table->string('ed_bairro_logradouro', 200)->nullable();
            $table->integer('id_municipio_logradouro');
            $table->foreign('id_municipio_logradouro')->references('id_municipio')->on('mf.municipio');    
            $table->string('no_representante', 200);
            $table->string('nr_telefone', 15);
            $table->string('ds_email', 100)->nullable();
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
        Schema::dropIfExists('spoa_portal_gescon.contratada');
    }
}
