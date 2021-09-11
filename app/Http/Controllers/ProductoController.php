<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index(Request $request)
    {

        $productos = Producto::with('detfacturas')->paginate(10);

        $doperm=false;

        if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'administrar') )
          $doperm=true;
      
        if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
            $doperm=false;

       if($doperm==true)
            return view('productos.index',['productos'=>$productos]);
       else
           return view('sinpermiso'); 

        
    }

    public function store(Request $request)
    {

        $request->validate([

            'nombre' => 'required',
            'lente'=>'required',

            'valor' => ['required',function ($attribute,$value,$fail){
                if ($value<1000)
                    $fail('Valor no puede ser menor a $1.000.');
                }
            ],

        ]);

        $producto = Producto::create(['nombre'=> $request->nombre,'valor'=> $request->valor,'lente'=> $request->lente]);

        return response()->json(["success" => true,'ruta'=>route('productos.index')]);
    }

    public function update(Request $request)
    {

        $request->validate([
            
            'nombre' => 'required',
            'lente'=>'required',

            'valor' => ['required',function ($attribute,$value,$fail){
                if ($value<1000)
                    $fail('Valor no puede ser menor a $1.000.');
                }
            ],

        ]);

        $productoact = Producto::find(request()->id);
        $productoact->update(request()->only('nombre','lente','valor'));

        
        return response()->json(["success" => true,'ruta'=>route('productos.index')]);
    }

    public function existe(Request $request){

        if(isset($_POST['idid']))
            $idid=$_POST['idid'];
        
        if (!empty($idid))
            $producto = Producto::where('id',$idid)->get();
        
        return response()->json(['producto' => $producto]);
    }

    public function destroy(Request $request)
    {

        $res=false;
        $productoact = Producto::find(request()->idid);

        if($productoact){
            $productoact->delete();
            $res=true;
        }

        return response()->json(["success" => $res,'ruta'=>route('productos.index')]);
    }

    public function desactiva(Request $request)
    {

        $res=false;
        $productoact = Producto::find(request()->idid);
        
        if($productoact){

            $productoact->update(['activo'=>$productoact->activo==true?false:true]);

            $res=true;
        }


        
        return response()->json(["success" => $res,'ruta'=>route('productos.index')]);
    }

    
}
