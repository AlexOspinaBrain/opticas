<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewUsuariosripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW usuariosrips AS SELECT 
                `tiposid`.`codtipoid` AS `tipoid`,
                `clientes`.`cedula` AS `cedula`,
                'SDS001' AS `CEA`,
                '4' AS `tipousuario`,
                `clientes`.`priape` AS `priape`,
                `clientes`.`segape` AS `segape`,
                `clientes`.`prinom` AS `prinom`,
                `clientes`.`segnom` AS `segnom`,
                YEAR(CURDATE()) - YEAR(`clientes`.`nacimiento`) + IF(DATE_FORMAT(CURDATE(), '%m-%d') > DATE_FORMAT(`clientes`.`nacimiento`, '%m-%d'),
                    0,
                    - 1) AS `edad`,
                IF(YEAR(CURDATE()) - YEAR(`clientes`.`nacimiento`) + IF(DATE_FORMAT(CURDATE(), '%m-%d') > DATE_FORMAT(`clientes`.`nacimiento`, '%m-%d'),
                        0,
                        - 1) = 0,
                    IF(MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`) > 0,
                        MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`),
                        IF(12 - ABS(MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`)) = 12,
                            ABS(DAYOFMONTH(CURDATE()) - DAYOFMONTH(`clientes`.`nacimiento`)),
                            12 - ABS(MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`)))),
                    YEAR(CURDATE()) - YEAR(`clientes`.`nacimiento`) + IF(DATE_FORMAT(CURDATE(), '%m-%d') > DATE_FORMAT(`clientes`.`nacimiento`, '%m-%d'),
                        0,
                        - 1)) AS `edadreal`,
                RIGHT(IF(YEAR(CURDATE()) - YEAR(`clientes`.`nacimiento`) + IF(DATE_FORMAT(CURDATE(), '%m-%d') > DATE_FORMAT(`clientes`.`nacimiento`, '%m-%d'),
                            0,
                            - 1) = 0,
                        IF(MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`) > 0,
                            CONCAT(MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`),
                                    '2'),
                            IF(12 - ABS(MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`)) = 12,
                                CONCAT(ABS(DAYOFMONTH(CURDATE()) - DAYOFMONTH(`clientes`.`nacimiento`)),
                                        '3'),
                                CONCAT(12 - ABS(MONTH(CURDATE()) - MONTH(`clientes`.`nacimiento`)),
                                        '2'))),
                        CONCAT(YEAR(CURDATE()) - YEAR(`clientes`.`nacimiento`) + IF(DATE_FORMAT(CURDATE(), '%m-%d') > DATE_FORMAT(`clientes`.`nacimiento`, '%m-%d'),
                                    0,
                                    - 1),
                                '1')),
                    1) AS `umedidaedad`,
                `clientes`.`genero` AS `genero`,
                LPAD(`municipios`.`coddep`, 2, '0') AS `coddep`,
                LPAD(`municipios`.`codmun`, 3, '0') AS `codmun`,
                'U' AS `zona`,
                `historias`.`created_at` AS `created_at`
            FROM
                (((`historias`
                JOIN `clientes` ON (`historias`.`clienteid_id` = `clientes`.`id`))
                JOIN `tiposid` ON (`clientes`.`tiposid_id` = `tiposid`.`id`))
                JOIN `municipios` ON (`clientes`.`municipio_id` = `municipios`.`id`));");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW usuariosrips");
    }
}
