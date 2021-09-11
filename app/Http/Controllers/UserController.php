<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {

            $users = User::paginate(10);

            $doperm=false;

            if( auth()->user()->hasTeamRole(auth()->user()->currentTeam,'usuarios') )
                $doperm=true;
            
            if(auth()->user()->currentTeam->id == auth()->user()->personalTeam()->id)
                $doperm=false;

           if($doperm==true)
              return view('usuarios.index',['usuarios'=>$users]);
           else
               return view('sinpermiso');  

      
    }
    public function existe(Request $request){
        $users=User::find($request->idid);

        return response()->json(['usuario'=>$users]);
        
    }
    public function update(Request $request){
        $thisok=false;
        
        $request->validate([
            'name'=>'required|min:8',
            'email'=>'required|email'
        ]);

        $users=User::find($request->id);
        if ($users){
            $users->name=$request->name;
            $users->email=$request->email;
            $thisok=$users->save();
        }
        return Response()->json(['success'=>$thisok,'ruta'=>route('usuarios.index')]);
    }
}
