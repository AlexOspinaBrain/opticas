<?php

namespace App\Imports;

use App\Models\Cie10tmp;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Cie10Import implements ToModel, WithHeadingRow
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cie10tmp([
            'codigo'=>$row['codigo'],
            'nombre'=>$row['nombre'],     
            'sexo'=>$row['sexo'], 
            'edadminima'=>$row['edadminima'], 
            'edadmaxima'=>$row['edadmaxima'], 

        ]);
    }
}
