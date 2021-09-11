<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Tiposid;
use App\Models\Eps;
use App\Models\Municipios;
use App\Models\Pais;
use App\Models\Estadocivil;

use App\Http\Requests\GuardarClienteRequest;

class ClienteController extends Controller
{
    protected $doperm;


    public function index(Request $request){

        $tiposid = Tiposid::all();
        $eps = Eps::orderby('nombre')->get();
        $municipio = Municipios::where('coddep',11)->get();
        $municipio1 = Municipios::whereNotIn('coddep',[11])->get();
        $pais = Pais::all();
        $estciv = Estadocivil::all();
      
        $cedula = $request->get('schcedula');
  
        if ($cedula){
          $clientes = Cliente::where('cedula',$cedula)->paginate(10);
        }else
          $clientes = Cliente::paginate(10);
  
          $this->doperm=false;

          if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'clientes') )
            $this->doperm=true;
          
          if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
            $this->doperm=false;          
          


         if($this->doperm==true)
            return view('clientes.index',['clientes'=>$clientes,'tiposid'=>$tiposid,'eps'=>$eps,'municipio'=>$municipio,'municipio1'=>$municipio1,'pais'=>$pais,'estciv'=>$estciv]);
         else
             return view('sinpermiso');

          
            
    }

    public function crea()
    {
        $tiposid = Tiposid::all();
        $eps = Eps::orderby('nombre')->get();
        $municipio = Municipios::where('coddep',11)->get();
        $municipio1 = Municipios::whereNotIn('coddep',[11])->get();
        $pais = Pais::all();
        $estciv = Estadocivil::all();
        
        $this->doperm=false;

        if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'clientes') )
            $this->doperm=true;
            
        if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
            $this->doperm=false;

       if($this->doperm==true)
            return view('cliente',['tiposid'=>$tiposid,'eps'=>$eps,'municipio'=>$municipio,'municipio1'=>$municipio1,'pais'=>$pais,'estciv'=>$estciv]);
       else
           return view('sinpermiso');

    }
    
    public function store(GuardarClienteRequest $request){
        

        $cliente = Cliente::create(request()->only('tiposid_id','cedula','nacimiento','prinom','segnom','priape','segape','ocupacion','email',
            'direccion','celular','eps_id','estadocivil_id','hijos','genero','municipio_id','pais_id'));
        
        if (request()->vmodal == "vmodal")
            return Response()->json(["success" => true,"cliente"=>$cliente]);
        else
            return Response()->json(["success" => true,"URL"=>route('cliente')]);
    }

    public function clienteexiste(){
        
        $user="";
        if (isset($_POST['tipo']) && isset($_POST['numero'])){
            $tipo=$_POST['tipo'];
            $numero=$_POST['numero'];

            if (!empty($tipo) && !empty($numero)) {
            
                $user = Cliente::where('cedula', '=', $numero)
                    ->where('tiposid_id', '=', $tipo)
                    ->first();
                    
            }

        } 
        if(isset($_POST['idid'])){
            $idid=$_POST['idid'];
        
            if (!empty($idid)) {
            
                $user = Cliente::where('id',$idid)->first();
            }
        }
        
        return Response()->json(['user' => $user]);
    }

    public function update(GuardarClienteRequest $request)
    {

        $clienteact = Cliente::find(request()->id);
        $clienteact->update(request()->only('tiposid_id','cedula','nacimiento','prinom','segnom','priape','segape','ocupacion','email',
        'direccion','celular','eps_id','estadocivil_id','hijos','genero','municipio_id','pais_id'));

        
        return Response()->json(["success" => true,"URL"=>route('cliente'),'ruta'=>route('clientes.index')]);
    }

    public function destroy($id){

        $cliente = Cliente::find($id);
        $res="";
        
        if($cliente){
            $cliente->delete();
            $res="success";
        }else
            $res="error";

        return Response()->json(["success" => $res, 'ruta'=>route('clientes.index')]);
    }    


}
