<?php

namespace App\Http\Controllers;
use App\Models\Detfactura;
use App\Models\Producto;
use App\Models\Factura;
use App\Models\Detfaclente;
//use Illuminate\Routing\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DetfacturaController extends Controller
{

    public function store (Request $request){

        //valida
        $request->validate([
            'productosid_id' => 'required',
            'cantidad' => 'required|numeric|min:1|max:20',
            'facturasid_id' => 'required',
        ]);
        
        //trae el nombre del producto
        $vlrproducto = Producto::where('id', '=', $request->productosid_id)->first();
        $prodd = $vlrproducto->nombre;

        //crea el item
        $detfactura = Detfactura::create([
            'facturasid_id' => $request->facturasid_id,
            'productosid_id' => $request->productosid_id,
            'cantidad' => $request->cantidad,
            'valoritem' => $vlrproducto->valor,
            'valortotitem' => $vlrproducto->valor * $request->cantidad,
        ]);

        //actualiza datos factura
        $actualiza = $this->actualizafactura($request->facturasid_id);

        $serie= $actualiza['serie'];
        $valfactura = $actualiza['valfactura'];
        $abono = $actualiza['abono'];

        //devolucion ajax json
        return Response()->json(["success" => true,"detfactura"=>$detfactura,"serie"=>$serie,"nomprod"=>$prodd,"valfactura"=>$valfactura,"abono"=>$abono]);
    }

    public function destroy($id){

        $item = Detfactura::find($id);
        
        $lente = Detfaclente::where('detfacturasid_id', '=',$id)->first();
        if($lente)
            $lente->delete();
            
        $idfactura = $item->facturasid_id;
        

        if($item->delete()){
            $res="success";
            
            //actualiza datos factura
            $actualiza = $this->actualizafactura($idfactura);

            $detfactura = $actualiza['detfactura'];
            $valfactura = $actualiza['valfactura'];
            $abono = $actualiza['abono'];
        
        }else
            $res="error";

        return Response()->json(["success" => $res, "detfactura"=>$detfactura,'valfactura'=>$valfactura,'abono'=>$abono]);
    }


    private function actualizafactura($idfactura = 0){
        
        //trae la cantidad de items de la factura
        $serie = Detfactura::where('facturasid_id', '=', $idfactura)->count();

        //trae detalle factura
        $detfactura = Detfactura::where('facturasid_id', '=',$idfactura)->with('productos')->get();
                    
        //trae el valor de la suma de los items
        $valfactura = Detfactura::where('facturasid_id', '=',$idfactura)->get()->sum('valortotitem');

        //actualiza datos totales de la factura
        $factura = Factura::find($idfactura);
        $factura->subtotal = $valfactura;
        $factura->total = $valfactura;
        $abono = $factura->abono;
        $factura->save();

        
        $arrres = array('serie'=>$serie,'detfactura'=>$detfactura,'valfactura'=>$valfactura,'factura'=>$factura,'abono'=>$abono);
        return  $arrres;
    }
}
