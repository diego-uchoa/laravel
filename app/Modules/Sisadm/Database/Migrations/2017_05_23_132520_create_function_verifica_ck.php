<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionVerificaCk extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       DB::statement("CREATE OR REPLACE FUNCTION spoa_portal.verifica_ck()
        RETURNS void AS $$
        DECLARE
            C_INCONSISTENCIA CURSOR IS
            SELECT cons.table_name, cons.constraint_name, cons.constraint_schema FROM information_schema.table_constraints cons
            where cons.constraint_type = 'CHECK'
            and  constraint_name !~* '^\w+_not_null$'  /* '^(CK)_.+_\d+$' */
            and (cons.table_schema like 'spoa%' or cons.table_schema = 'mf');
                   
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
                   'CK_INVALIDO',
                   R_INCONSISTENCIA.CONSTRAINT_NAME,
                   R_INCONSISTENCIA.TABLE_NAME,
                   '',
                   R_INCONSISTENCIA.CONSTRAINT_SCHEMA
                );
               
          END LOOP;
              
            
        END;
        $$ LANGUAGE plpgsql;");

       DB::statement("ALTER FUNCTION spoa_portal.verifica_ck()
                           OWNER TO spoa_portal;");

       DB::statement("COMMENT ON FUNCTION spoa_portal.verifica_ck()
                           IS 'Verifica ck';");
   }

  /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       DB::statement('DROP FUNCTION spoa_portal.verifica_ck()');
   }
}
