<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionVerifica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE FUNCTION spoa_portal.verifica()
        RETURNS void AS $$
        BEGIN

          DELETE FROM spoa_portal.inconsistencia; 
          
          PERFORM spoa_portal.verifica_tabela_campos(); 
          PERFORM spoa_portal.verifica_tabela_pk(); 
          PERFORM spoa_portal.verifica_view();
          PERFORM spoa_portal.verifica_sq();
          PERFORM spoa_portal.verifica_trigger();
          PERFORM spoa_portal.verifica_fk();
          PERFORM spoa_portal.verifica_uk();
          PERFORM spoa_portal.verifica_ck();
            
        END;
        $$ LANGUAGE plpgsql;");

        DB::statement("ALTER FUNCTION spoa_portal.verifica()
                            OWNER TO spoa_portal;");

        DB::statement("COMMENT ON FUNCTION spoa_portal.verifica()
                            IS 'Realiza verificações de inconsistências no banco de dados';");
    }

   /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP FUNCTION spoa_portal.verifica()');
    }
}
