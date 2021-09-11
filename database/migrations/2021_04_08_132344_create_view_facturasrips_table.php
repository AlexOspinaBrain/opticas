<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewFacturasripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW facturasrips AS SELECT 
                '110011783501' AS `id`,
                'Flor Carolina Tovar Deaza' AS `nom`,
                'CC' AS `tipoid`,
                '52337281' AS `cedula`,
                `facturas`.`id` AS `fac`,
                `historias`.`created_at` AS `created_at`,
                DATE_FORMAT(`historias`.`created_at`, '%d/%m/%Y') AS `fecha`,
                'SDS001' AS `idsec`,
                'SECRETARIA DISTRITAL DE SALUD' AS `sec`,
                '' AS `v1`,
                '' AS `v2`,
                '' AS `v3`,
                0 AS `c1`,
                0 AS `c2`,
                0 AS `c3`,
                `detfacturas`.`valoritem` AS `valoritem`
            FROM
                ((`facturas`
                JOIN `detfacturas` ON (`facturas`.`id` = `detfacturas`.`facturasid_id`))
                JOIN `historias` ON (`historias`.`facturasid_id` = `detfacturas`.`facturasid_id`
                    AND `historias`.`clienteid_id` = `detfacturas`.`clientesid_id`))
            WHERE
                `facturas`.`confirmada` = 1
                    AND `facturas`.`cancelada` = 0
                    AND `detfacturas`.`productosid_id` = 1;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW facturasrips");
    }
}
