<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;

use App\Models\Eps;
use App\Models\Municipios;
use App\Models\Pais;
use App\Models\Estadocivil;

use App\Models\Cliente;
use App\Models\Tiposid;
use App\Models\Cie10;
use App\Models\Factura;
use App\Models\Detfactura;

use Illuminate\Database\Eloquent\Builder;


class HistoriaController extends Controller
{
    
    public function index(Request $request)
    {
       $tiposid = Tiposid::all();
       $cie10 = "";

       $cedula = $request->get('schcedula');
  
       if (!\Cache::has('cie10')){
                $cie10 = Cie10::all();
                \Cache::put('cie10', $cie10, 600); // 10 Minutes
        }else $cie10 = \Cache::get('cie10');
        
        
                $obj = "<select class='form-control' name='cie10id_id' value='{{old(\'cie10id_id\')}}' required>";
                $obj .= "<option value=''></option>";
                foreach ($cie10 as $cie10Item){
                    $obj .= "<option value='$cie10Item->id' {(old('cie10id_id')==$cie10Item->id)? 'selected':''}> $cie10Item->codigo - $cie10Item->nombre</option>";
                }
                $obj .= "</select>";
        

         if ($cedula){
            $historias = Historia::whereHas('cliente', function (Builder $query) use ($cedula) {
                $query->where('cedula', $cedula);
            })->where('usersid_id',auth()->id())->paginate(10);
          }else
            $historias = Historia::where('usersid_id',auth()->id())->orderBy('created_at','DESC')->paginate(10);


            $doperm=false;
            /*foreach (auth()->user()->teams as $team){
                if( auth()->user()->hasTeamPermission($team,'historias') )
                    $doperm=true;
            } */      

            if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'historias') )
              $doperm=true;
          
            if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
                $doperm=false;

           if($doperm==true)
                return view('historias.index',['historias'=>$historias,'obj'=>$obj,'tiposid'=>$tiposid]);
           else
               return view('sinpermiso');

      
    }

    public function crea(Request $request)
    {
       $tiposid = Tiposid::all();
       $cie10="";
       $eps = Eps::orderby('nombre')->get();
       $municipio = Municipios::where('coddep',11)->get();
       $municipio1 = Municipios::whereNotIn('coddep',[11])->get();
       $pais = Pais::all();
       $estciv = Estadocivil::all();       
       
       if (!\Cache::has('cie10')){
            $cie10 = Cie10::all();
            \Cache::put('cie10', $cie10, 600); // 10 Minutes
       }else $cie10 = \Cache::get('cie10');
       
       
       if (!\Cache::has('cie10obj')){
            $obj = "<select class='form-control' name='cie10id_id' value='".old('cie10id_id'). "' required>";
            $obj .= "<option value=''></option>";
            foreach ($cie10 as $cie10Item){
                $obj .= "<option value='$cie10Item->id' ";
                $obj .= (old('cie10id_id')==$cie10Item->id)? " selected ":"";
                $obj .= "> $cie10Item->codigo - $cie10Item->nombre</option>";
            }
            $obj .= "</select>";
            \Cache::put('cie10obj', $obj, 600); // 10 Minutes
            
       } else {
            $obj = \Cache::get('cie10obj');
            
       }
       

       if (isset($request->creado))
        $creado = $request->creado;
       else
        $creado = "";

        $doperm=false;

        if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'historias') )
            $doperm=true;
    
        if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
            $doperm=false;

       if($doperm==true)
           return view('historia',['obj'=>$obj,'cie10'=>$cie10,'creado'=>$creado,'tiposid'=>$tiposid,'eps'=>$eps,'municipio'=>$municipio,'municipio1'=>$municipio1,'pais'=>$pais,'estciv'=>$estciv]);
       else
           return view('sinpermiso');

      
    }

    public function store(Request $request){
        


        $request->validate([
            'clienteid_id' => 'required',
            'cie10id_id' => 'required',
            'prinomh'=>'required',
            'priapeh'=>'required',
            'anamnesis'=>'required|min:10',
            'conducta'=>'required|min:10',

            'edad' => [function ($attribute,$value,$fail){
                            if (($value<19||is_null($value)) && request()->cliente_factura_id=="")
                                $fail('Menor debe tener acompañante para expedir factura.');
                        }
                    ],
        ]);
        
        if ($request->cliente_factura_id != null && $request->cliente_factura_id > 0)
            $cedulafactura = $request->cliente_factura_id;
        else
            $cedulafactura = $request->clienteid_id;


        $factura= Factura::where('clienteid_id',$cedulafactura)
                ->where('confirmada', false)->where('cancelada',false)->first();
        if (!$factura){
            $factura = Factura::create([
                'clienteid_id'=> $cedulafactura,
                'subtotal'=>30000,
                'total'=>30000,
                
            ]);
        }else{
            $factura->subtotal = $factura->subtotal + 30000;
            $factura->total = $factura->subtotal;

            $factura->save();
            
        }

        $historia = Historia::create([
            'clienteid_id' => $request->clienteid_id,
            'cliente_factura_id' => $cedulafactura,
            'cie10id_id' => $request->cie10id_id,
            'cie10id_id2' => $request->cie10id_id2,
            'facturasid_id' => $factura->id,
            'anamnesis' => $request->anamnesis,
            'avscvlod' => $request->avscvlod,
            'avscvloi' => $request->avscvloi,
            'vpod' => $request->vpod,
            'vpoi' => $request->vpoi,
            'ao' => $request->ao,
            'exmextod' => $request->exmextod,
            'exmextoi' => $request->exmextoi,
            'convinf' => $request->convinf,
            'convdp' => $request->convdp,
            'cms' => $request->cms,
            'ppc' => $request->ppc,
            'tcolod' => $request->tcolod,
            'tcoli' => $request->tcoli,
            'smod' => $request->smod,
            'smoi' => $request->smoi,
            'test' => $request->test,
            'pris' => $request->pris,
            'ofod' => $request->ofod,
            'ofoi' => $request->ofoi,
            'qod' => $request->qod,
            'qoi' => $request->qoi,
            'tonod' => $request->tonod,
            'tonoi' => $request->tonoi,
            'refdimod' => $request->refdimod,
            'refdimoi' => $request->refdimoi,
            'refesod' => $request->refesod,
            'refesoi' => $request->refesoi,
            'subod' => $request->subod,
            'suboi' => $request->suboi,
            'rxod' => $request->rxod,
            'rxoi' => $request->rxoi,
            'add' => $request->add,
            'conducta' => $request->conducta,
            'esfod' => $request->esfod,
            'esfoi' => $request->esfoi,
            'cilod' => $request->cilod,
            'ciloi' => $request->ciloi,
            'ejeod' => $request->ejeod,
            'ejeoi' => $request->ejeoi,
            'addod' => $request->addod,
            'addoi' => $request->addoi,
            'avod' => $request->avod,
            'avoi' => $request->avoi,
        ]);

        $detfactura = Detfactura::create([
            'facturasid_id'=> $factura->id,
            'clientesid_id' => $request->clienteid_id,
            'productosid_id'=> 1,
            'valoritem'=>30000,
            'cantidad'=>1,
            'valortotitem'=>30000,
            'consulta'=>true,
        ]);

        return redirect()->route('historias', ['creado' => 'OK']);
        
    }

    public function existe(Request $request){

            if(isset($_POST['idid']))
                $idid=$_POST['idid'];
            
            if (!empty($idid))
                $historia = Historia::where('id',$idid)->with('cliente','clientefac')->get();
            
            return response()->json(['historia' => $historia]);
    }


    public function update(Request $request)
    {

        $request->validate([
            'clienteid_id' => 'required',
            'cie10id_id' => 'required',
            'prinomh'=>'required',
            'priapeh'=>'required',
            'anamnesis'=>'required|min:10',
            'conducta'=>'required|min:10',

            'edad' => [function ($attribute,$value,$fail){
                if (($value<19||is_null($value)) && request()->cliente_factura_id=="")
                    $fail('Menor debe tener acompañante para expedir factura.');
                }
            ],            
        ]);

        $historiaact = Historia::find(request()->id);
        $historiaact->update(request()->only('cie10id_id','cie10id_id2','anamnesis','avscvlod','avscvloi','vpod','vpoi','ao',
        'exmextod','exmextoi','convinf','convdp','cms','ppc','tcolod','tcoli','smod','smoi','test','pris','ofod','ofoi','qod',
        'qoi','tonod','tonoi','refdimod','refdimoi','refesod','refesoi','subod','suboi','rxod','rxoi','add','conducta','esfod',
        'esfoi','cilod','ciloi','ejeod','ejeoi','addod','addoi','avod','avoi'));

        
        return response()->json(["success" => true,'ruta'=>route('historias.index')]);
    }

}
