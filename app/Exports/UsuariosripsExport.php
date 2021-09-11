<?php

namespace App\Exports;

use App\Usuariosrips;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsuariosripsExport implements FromCollection
{

    use Exportable;

    protected $usuariosrips;
   
    
    public function __construct($usuariosrips = null){
        $this->usuariosrips = $usuariosrips;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->usuariosrips ?: Usuariosrips::all();
    }

 

}
