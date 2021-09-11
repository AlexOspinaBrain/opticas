<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Historia;
use App\Models\Usuariosrips;
use App\Models\Facturasrips;
use App\Models\Consultarips;

use Illuminate\Http\Request;

use App\Exports\UsuariosripsExport;
use App\Exports\FacturasripsExport;
use App\Exports\ConsultaripsExport;

use Illuminate\Database\Eloquent\Builder;

class InformesController extends Controller
{

    public function index(){

        $meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio', 'Agosto','Septiembre','Octubre','Noviembre','Diciembre');


        $doperm=false;

        if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'informes') )
          $doperm=true;
      
        if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
            $doperm=false;

       if($doperm==true)
       return view('informes.index',['meses'=>$meses]);
       else
           return view('sinpermiso');  


        
    }

    public function infrips(Request $request){

        $request->validate([
            //'fechaini' => 'required|before:today',
            //'fechafin' => 'required|before:today|after:fechaini',
            'ano' => ['required','max:4', 'min:4',
                        function ($attribute,$value,$fail){
                            if ($value>date('Y')||$value<2020)
                                $fail('Año Invalido');
                        }
                    ],
            'meses' => 'required',
        ]);

        $successu=false;
        $successf=false;
        $successc=false;
        
        $ultimodia = date("d", mktime(0,0,0, $request->meses+1, 0, $request->ano));

        $fechaini = date($request->ano.'-'.$request->meses.'-01');
        $fechafin = date($request->ano.'-'.$request->meses.'-'.$ultimodia.' 23:00:00');
        
        $usuariosrips=Usuariosrips::select('tipoid','cedula','CEA','tipousuario','priape','segape','prinom','segnom','edadreal','umedidaedad','genero','coddep','codmun','zona')
            ->whereBetween('created_at', [$fechaini, $fechafin])->distinct()->get();

            
        if ($usuariosrips){
            $successu=true;
            
            $this->grdusu($usuariosrips,'UsuariosRips.csv');
        }

        
/*
        $selects = array(
            'id',
            'nom',
            'tipoid','cedula','fac','fecha',            
            "'".date_format(date_create($fechaini),'d/m/Y')."' AS feini",
            "'".date_format(date_create($fechafin),'d/m/Y')."' AS fefin",
            'idsec','sec','v1','v2','v3','c1','c2','c3'
            );        

        $facturasrips=Facturasrips::selectraw(implode(',',$selects))
            ->selectraw('sum(valoritem) as valoritem')
            ->groupBy('fac')
            ->whereBetween('created_at', [$fechaini, $fechafin])->get();

            
            
        if ($facturasrips){
            $successf=true;
            $this->grdfact($facturasrips,'FacturasRips.csv');
        }
        

        $consultarips=Consultarips::select('factura','codigo','codtipoid','cedula','fecha','aut','cups','finalidad','causaext','cie10','o1','o2','o3','tipdiag','valoritem','cuotmod','val')
            ->whereBetween('created_at', [$fechaini, $fechafin])->get();

        if ($consultarips){
            $successc=true;
            $this->grdcst($consultarips,'ConsultasRips.csv');
        }
*/

        return redirect()->route('informes.index',['successu'=>$successu,'successf'=>$successf,'successc'=>$successc]);
        
        
    }

    function grdusu($modell = null, $archivo = null){
        return (new UsuariosripsExport($modell))->store($archivo, 'public');
        
    }
    function grdfact($modell = null, $archivo = null){
        return (new FacturasripsExport($modell))->store($archivo, 'public');
    }
    function grdcst($modell = null, $archivo = null){
        return (new ConsultaripsExport($modell))->store($archivo, 'public');
    }
}
