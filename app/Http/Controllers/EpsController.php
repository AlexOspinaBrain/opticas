<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;

use App\Imports\EpsImport;
use Maatwebsite\Excel\Facades\Excel;

class EpsController extends Controller
{
    public function importExportView()
    {
        $cie10="";
        if (request('cie10'))  $cie10 = request('cie10');
        

        
       return view('import.importar',['cie10'=>$cie10]);
    }

    public function import() 
    {
        Excel::import(new EpsImport,request()->file('file'));
             
        return back();
    }
}
