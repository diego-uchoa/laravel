<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Sisadm\Models\SiapeDadoPessoal;

class CreateSiapeDadoPessoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spoa_portal.siape_dado_pessoal', function (Blueprint $table) {
            $table->integer('id_usuario')->nullable();;
            $table->string('nr_cpf')->unique();
            $table->primary('nr_cpf');
            $table->string('no_pessoa', 200);
            $table->date('dt_nascimento');
            $table->string('in_estado_civil', 50);
            $table->string('no_mae', 200)->nullable();
            $table->string('no_pai', 200)->nullable();
            $table->string('in_sexo', 1);
            $table->string('sg_uf_nascimento', 2)->nullable();
            $table->string('no_municipio_nascimento', 100)->nullable();
            $table->string('nr_pis_pasep', 30)->nullable();
            $table->string('ds_foto')->nullable();
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
        Schema::table('spoa_portal.siape_dado_pessoal', function (Blueprint $table) {
            Schema::drop('spoa_portal.siape_dado_pessoal');
        });
    }
}
