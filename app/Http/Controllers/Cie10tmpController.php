<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cie10tmp;
use App\Models\Cie10;

use App\Imports\Cie10Import;
use Maatwebsite\Excel\Facades\Excel;

use DB;

class Cie10tmpController extends Controller
{


    public function import() 
    {
        $dropcie = Cie10tmp::truncate();
        /*$dropcie = Cie10tmp::all();
        $arrdrop[]="";
        foreach ($dropcie as $dropcieItem) { 
            $arrdrop[]=$dropcieItem->id;
        }

        $eliminados = Cie10tmp::destroy($arrdrop);*/

        Excel::import(new Cie10Import,request()->file('file'));
        
        $cuantos = Cie10tmp::count();

         return redirect()->route('importExportView',['cie10'=>$cuantos]);
    }
    
    public function actualizacie10(){

        $inserts = [];
        //$dropcie = Cie10::truncate();
        /*$bids = Cie10tmp::all();
    
        foreach($bids as $bid) {
            $inserts[] =  ['project_id' => $project_id,
                'category_id' => $category_id,
                'service_providers_id' => $service_providers_id,
                'bid_price' => $bid->bid_price,
                'property_value_id' => $property_value_id]; 
        }
    
        DB::table('cie10')->insert($inserts);
        */

        $sql = "insert into `cie10` (codigo,nombre,sexo,edadminima,edadmaxima) 
                select codigo,nombre,sexo,edadminima,edadmaxima from `cie10tmp`;";
        DB::unprepared($sql);

        $actualizacion="Ok";

        
        return redirect()->route('importExportView',['cie10'=>$actualizacion]);
    }
}