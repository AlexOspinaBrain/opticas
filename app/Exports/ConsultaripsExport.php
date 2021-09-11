<?php

namespace App\Exports;

use App\Consultarips;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConsultaripsExport implements FromCollection
{
    use Exportable;

    protected $consultarips;
   
    
    public function __construct($consultarips = null){
        $this->consultarips = $consultarips;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->consultarips ?: Consultarips::all();
    }
}
