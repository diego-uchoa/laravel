<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionVerificaSq extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       DB::statement("CREATE OR REPLACE FUNCTION spoa_portal.verifica_sq()
        RETURNS void AS $$
        DECLARE
            C_INCONSISTENCIA CURSOR IS
            SELECT SEQUENCE_NAME, SEQUENCE_SCHEMA FROM information_schema.sequences
            WHERE SEQUENCE_NAME !~* '^\w+_seq$'  /* ^(SQ)_\w{2} */
            AND (SEQUENCE_SCHEMA LIKE 'spoa%' OR SEQUENCE_SCHEMA = 'mf');
                   
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
                    'SEQUENCE_INVALIDO',
                    R_INCONSISTENCIA.SEQUENCE_NAME,
                    '',
                    '',
                    R_INCONSISTENCIA.SEQUENCE_SCHEMA
                );
               
          END LOOP;
              
            
        END;
        $$ LANGUAGE plpgsql;");

       DB::statement("ALTER FUNCTION spoa_portal.verifica_sq()
                           OWNER TO spoa_portal;");

       DB::statement("COMMENT ON FUNCTION spoa_portal.verifica_sq()
                           IS 'Verifica sq';");
   }

  /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       DB::statement('DROP FUNCTION spoa_portal.verifica_sq()');
   }
}
