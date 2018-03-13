<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionVerificaView extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       DB::statement("CREATE OR REPLACE FUNCTION spoa_portal.verifica_view()
        RETURNS void AS $$
        DECLARE
            C_INCONSISTENCIA CURSOR IS
            SELECT TABLE_NAME,TABLE_SCHEMA FROM information_schema.views v
            WHERE V.table_name !~* '^(VW)_\w{2}'
            and (v.table_schema like 'spoa%' or v.table_schema = 'mf');
               
        BEGIN


          FOR R_INCONSISTENCIA IN C_INCONSISTENCIA LOOP
                
                insert into spoa_portal.inconsistencia
                ( TX_INCONSISTENCIA,
                  NO_CAMPO,
                  NO_TABELA,
                  TX_TIPO_CAMPO,
                  NO_USUARIO
                )
                values ( 
                    'VIEW_INVALIDO',
                    R_INCONSISTENCIA.TABLE_NAME,
                    '',
                    '',
                    R_INCONSISTENCIA.TABLE_SCHEMA
                );
                
          END LOOP;

            
            
        END;
        $$ LANGUAGE plpgsql;");

       DB::statement("ALTER FUNCTION spoa_portal.verifica_view()
                           OWNER TO spoa_portal;");

       DB::statement("COMMENT ON FUNCTION spoa_portal.verifica_view()
                           IS 'Verifica view';");
   }

  /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       DB::statement('DROP FUNCTION spoa_portal.verifica_view()');
   }
}
