<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionRemoveAcentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE FUNCTION spoa_portal.remove_acento(
                            text)
                            RETURNS text
                            LANGUAGE 'sql'
                            COST 100.0
                            IMMUTABLE NOT LEAKPROOF STRICT 
                        AS $$

                        SELECT TRANSLATE($1,'áàãâäÁÀÃÂÄéèêëÉÈÊËíìîïÍÌÎÏóòõôöÓÒÕÔÖúùûüÚÙÛÜñÑçÇÿýÝ','aaaaaAAAAAeeeeEEEEiiiiIIIIoooooOOOOOuuuuUUUUnNcCyyY')

                        $$;");

        DB::statement("ALTER FUNCTION spoa_portal.remove_acento(text)
                            OWNER TO spoa_portal;");

        DB::statement("COMMENT ON FUNCTION spoa_portal.remove_acento(text)
                            IS 'Remove letras com acentuação';");
    }

   /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP FUNCTION spoa_portal.remove_acento(text)');
    }
}
