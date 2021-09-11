<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detfactura;
use App\Models\Detfaclente;

class DetfaclenteController extends Controller
{
    public function graba (Request $request){

        //valida
        /*$request->validate([
            'productosid_id' => 'required',
            'cantidad' => 'required|numeric|min:1|max:20',
            'facturasid_id' => 'required',
        ]);
        */

        //
        $detfaclente = Detfaclente::where('detfacturasid_id',$request->detfacturasid_id)->first();

        if($detfaclente){
            //actualiza el detalle de lente
            $detfaclente->update(request()->only('lesferaoi','lesferaod','lcilindroi','lcilindrod','lejei','lejed','laddi','laddd','ldpi',
                'ldpd','cesferaoi','cesferaod','ccilindroi','ccilindrod','cejei','cejed','caddi','caddd','cdpi','cdpd'));
        }
        else{
            //crea el detalle de lente
            Detfaclente::create(request()->only('detfacturasid_id','lesferaoi','lesferaod','lcilindroi','lcilindrod','lejei','lejed','laddi','laddd','ldpi',
                'ldpd','cesferaoi','cesferaod','ccilindroi','ccilindrod','cejei','cejed','caddi','caddd','cdpi','cdpd'));
        }

        //devolucion ajax json
        return Response()->json(["success" => true]);
    }

    public function detalle(Request $request){

        $detfacturasid_id = $request->id;

        $detfaclente = Detfaclente::where('detfacturasid_id',$detfacturasid_id)->first();
        
        $existe = false;
        if ($detfaclente)
            $existe = true;
        
            //devolucion ajax json
        return Response()->json(["existe" => $existe,"detfaclente"=>$detfaclente]);
    }

}
