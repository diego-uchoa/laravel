<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Modules\Prisma\Enum\PerfilUsuario;

class AddCargoPerfilToUsuarioInstituicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spoa_portal_prisma_s1.usuario_instituicao', function(Blueprint $table)
        {
            $table->text('no_cargo')->nullable();
            $table->enum('in_perfil',PerfilUsuario::getKeys())->nullable();
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
