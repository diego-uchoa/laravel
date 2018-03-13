<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionVerificaTrigger extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       DB::statement("CREATE OR REPLACE FUNCTION spoa_portal.verifica_trigger()
        RETURNS void AS $$
        DECLARE
            C_INCONSISTENCIA CURSOR IS
            SELECT TRIGGER_NAME, TRIGGER_SCHEMA FROM information_schema.triggers
            WHERE TRIGGER_NAME !~*  '^(SQ)_\w{2}'
            AND (TRIGGER_SCHEMA LIKE 'spoa%' OR TRIGGER_SCHEMA = 'mf');
                   
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
                    'TRIGGER_INVALIDO',
                    R_INCONSISTENCIA.TRIGGER_NAME,
                    '',
                    '',
                    R_INCONSISTENCIA.TRIGGER_SCHEMA
                );
               
          END LOOP;
              
            
        END;
        $$ LANGUAGE plpgsql;");

       DB::statement("ALTER FUNCTION spoa_portal.verifica_trigger()
                           OWNER TO spoa_portal;");

       DB::statement("COMMENT ON FUNCTION spoa_portal.verifica_trigger()
                           IS 'Verifica trigger';");
   }

  /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       DB::statement('DROP FUNCTION spoa_portal.verifica_trigger()');
   }
}
