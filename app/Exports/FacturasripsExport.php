<?php

namespace App\Exports;

use App\Facturasrips;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacturasripsExport implements FromCollection
{
    use Exportable;

    protected $facturasrips;
   
    
    public function __construct($facturasrips = null){
        $this->facturasrips = $facturasrips;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->facturasrips ?: Facturasrips::all();
    }
}
