<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Tiposid;
use App\Models\Cliente;
use App\Models\Eps;
use App\Models\Municipios;
use App\Models\Pais;
use App\Models\Estadocivil;

use App\Models\Factura;
use App\Models\Detfactura;
use App\Models\Detfaclente;

use App\Rules\abonovalido;

use Illuminate\Database\Eloquent\Builder;

class FacturaController extends Controller
{

    public function index(Request $request){
      
      
      $cedula = $request->get('schcedula');

      if ($cedula){
        $facturas = Factura::whereHas('cliente', function (Builder $query) use ($cedula) {
            $query->where('cedula', $cedula);
        })->where('usersid_id',auth()->id())->paginate(10);
      }else
        $facturas = Factura::where('usersid_id',auth()->id())->orderBy('created_at','DESC')->paginate(10);

        $doperm=false;

        if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'facturas') )
          $doperm=true;
      
        if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
            $doperm=false;
        
       if($doperm==true)
           return view('factura.index',compact('facturas'));
       else
           return view('sinpermiso');        
      
    }

    

    public function update(Request $request){

      $factura = Factura::find($request->idfact);
      $factura->cancelada = true;
      $factura->save();

      return redirect(route('factura.index'));
      
    }

    public function abono(Request $request){

      $factura = Factura::find($request->facturaida);

        //valida
      $request->validate([
          'abono'=>['required','numeric',
                    new abonovalido($factura->total),
                ],
      ]);
      
      
      $factura->abono = $request->abono;
      $factura->save();
      
      return redirect(route('factura.index'));
      
    }    

    public function genera(Request $request)
    {
        $tiposid = Tiposid::all();
        $producto = Producto::where('activo','1')->get();
        

        $eps = Eps::orderby('nombre')->get();
        $municipio = Municipios::where('coddep',11)->get();
        $municipio1 = Municipios::whereNotIn('coddep',[11])->get();
        $pais = Pais::all();
        $estciv = Estadocivil::all();  

        
       
       if (isset($request->creado))
        $creado = $request->creado;
       else
        $creado = "";

        $doperm=false;

        if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'facturas') )
          $doperm=true;
      
        if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
            $doperm=false;

       if($doperm==true)
           return view('factura',['creado'=>$creado,'producto'=>$producto, 'tiposid'=>$tiposid, 'eps'=>$eps,'municipio'=>$municipio,'municipio1'=>$municipio1,'pais'=>$pais,'estciv'=>$estciv]);
       else
           return view('sinpermiso');        

      
    }

    public function facturacliente(Request $request){
        $clienteid_id = $request->cliente;

        $factura = Factura::where('clienteid_id',$clienteid_id)->where('confirmada',false)->where('cancelada',false)->first();
        
        $detfactura="";
        if ($factura)
          $detfactura = Detfactura::where('facturasid_id',$factura->id)->with('productos')->get();
        
        return response()->json(['factura'=>$factura,'detfactura'=>$detfactura]);

        
    }

    public function crea (Request $request){

      //valida
      $request->validate([
          'clienteid_id' => 'required',
      ]);
      
      //crea factura
      $factura = Factura::create([
          'clienteid_id'=> $request->clienteid_id,
      ]);
      
      //devolucion ajax json
      return Response()->json(["success" => true,"factura"=>$factura]);
    }

    public function confact (Request $request){

      //valida
      $request->validate([
          'clienteid_id' => 'required',
          'total' => 'required|numeric|min:1000',
          'abono' => 'nullable|numeric',
      ]);
      
      //confirma y actualiza factura
      $success='success';
      $factura= Factura::where('id',$request->id)->first();
      if (!$factura){
          $success='Error General-busque nuevamente al cliente.';
      }else{
          $factura->subtotal = $request->total;
          $factura->abono = $request->abono;
          $factura->total = $request->total;
          $factura->confirmada = true;
          $factura->usersid_id = auth()->id();
          $factura->save();
        
      }      
      
      //devolucion ajax json
      return Response()->json(["success" => $success]);
      
    }

    
    public function imprime(Request $request)
    {
      $detfactura=null;
      $detfaclente=null;
      $factura = Factura::where('id',$request->id)->with('cliente')->get();
      if (!$factura){
        $detfactura = Detfactura::where('facturasid_id',$factura->id)->get();
        if (!$detfactura)
          $detfaclente = Detfaclente::where('detfacturasid_id',$detfactura->id)->get();
      }

      return view('facturaimp',['factura'=>$factura,'detfactura'=>$detfactura,'detfaclente'=>$detfaclente]);
    }




    public function download()
    {

      $pdf = \PDF::loadView('components.factura');

      return $pdf->download('archivo.pdf');

    }
}
