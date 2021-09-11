<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewConsultaripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW consultarips AS SELECT 
                `facturas`.`id` AS `factura`,
                '110011783501' AS `codigo`,
                `tiposid`.`codtipoid` AS `codtipoid`,
                `clientes`.`cedula` AS `cedula`,
                DATE_FORMAT(`historias`.`created_at`, '%d/%m/%Y') AS `fecha`,
                `historias`.`created_at` AS `created_at`,
                '' AS `aut`,
                '890207' AS `cups`,
                '08' AS `finalidad`,
                IF(`cie10`.`codigo` = 'Z010',
                    '15',
                    '13') AS `causaext`,
                `cie10`.`codigo` AS `cie10`,
                '' AS `o1`,
                '' AS `o2`,
                '' AS `o3`,
                '2' AS `tipdiag`,
                `detfacturas`.`valoritem` AS `valoritem`,
                '' AS `cuotmod`,
                `detfacturas`.`valoritem` AS `val`
            FROM
                (((((`facturas`
                JOIN `detfacturas` ON (`detfacturas`.`facturasid_id` = `facturas`.`id`))
                JOIN `historias` ON (`historias`.`clienteid_id` = `detfacturas`.`clientesid_id`))
                JOIN `clientes` ON (`clientes`.`id` = `detfacturas`.`clientesid_id`))
                JOIN `tiposid` ON (`tiposid`.`id` = `clientes`.`tiposid_id`))
                JOIN `cie10` ON (`cie10`.`id` = `historias`.`cie10id_id`))
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
        DB::statement("DROP VIEW consultarips");
    }
}
