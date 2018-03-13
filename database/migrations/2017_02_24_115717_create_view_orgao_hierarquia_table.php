<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewOrgaoHierarquiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE MATERIALIZED VIEW spoa_portal.vw_orgao_hierarquia AS WITH RECURSIVE vw_orgao_hierarquia AS
                            (
                            SELECT o.id_orgao, 
                                    o.sg_orgao, 
                                    o.no_orgao, 
                                    CAST(o.sg_orgao as text) as sg_orgao_completa 
                                FROM spoa_portal.orgao as o
                                WHERE id_orgao_id is null AND o.deleted_at IS NULL
                            UNION ALL
                            SELECT o2.id_orgao, 
                                    o2.sg_orgao, 
                                    o2.no_orgao, 
                                    CAST(vw_orgao_hierarquia.sg_orgao_completa || ' / ' || o2.sg_orgao as text) as sg_orgao_completa 
                                FROM spoa_portal.orgao as o2 
                                    INNER JOIN vw_orgao_hierarquia ON o2.id_orgao_id = vw_orgao_hierarquia.id_orgao
                                WHERE o2.deleted_at IS NULL
                            )
                            SELECT id_orgao, 
                                    sg_orgao, 
                                    no_orgao, 
                                    sg_orgao_completa, 
                                    CASE WHEN (SELECT COUNT(id_orgao) FROM spoa_portal.orgao o WHERE o.id_orgao_id = vw.id_orgao) > 0 THEN 0 ELSE 1 END as sn_unidade_final
                            FROM vw_orgao_hierarquia vw
                            ORDER BY vw.sg_orgao_completa
                            WITH DATA;");

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP MATERIALIZED VIEW IF EXISTS spoa_portal.vw_orgao_hierarquia' );
    }
}
