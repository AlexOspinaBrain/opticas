<?php

namespace App\Imports;

use App\Models\Eps;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EpsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Eps([
            'codigo'=>$row['codigo'],
            'nombre'=>$row['nombre'],
        ]);
    }
}
