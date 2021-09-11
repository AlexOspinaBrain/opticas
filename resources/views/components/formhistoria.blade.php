@csrf
<div class="container-fluid fs-1">
    <div id = "form-errorsh"></div>
    <div class="row row-cols-4">
        <div class="col">
            <div class="form-group">
            <label class="small" for="tiposid_id">Tipo Identificación Paciente</label>
                <select class="form-control" id="tiposid_idh" name="tiposid_id" value="{{old('tiposid_id')}}">
                    <option value="1" selected>CC-Cedula Ciudadanía</option>
                    @foreach ($tiposid as $tiposidItem)
                        <option value="{{$tiposidItem->id}}"> {{$tiposidItem->codtipoid . "-" . $tiposidItem->tipoid}}</option> 
                    @endforeach
                </select>
                
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="small" for="cedula">Identificación Paciente</label>
                <input type="number" class="form-control historia borra" id="cedulah" name="cedula"  value="{{old('cedula')}}" required >
                
                {!! $errors->first('cedulah','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="small" for="prinomh">Primer Nombre</label>
                <input type="text" class="form-control borra" name="prinomh" value="{{old('prinomh')}}" readonly>
                {!! $errors->first('prinomh','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="small" for="priapeh">Primer Apellido</label>
                <input type="text" class="form-control borra" name="priapeh" value="{{old('priapeh')}}" readonly>
                {!! $errors->first('priapeh','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                
            </div>
        </div>
    </div>
    <div><input type="hidden" name="clienteid_id" value="{{old('clienteid_id')}}"/> </div>  
    <div><input type="hidden" name="cliente_factura_id" value="{{old('cliente_factura_id')}}"/> </div> 
    <div><input type="hidden" name="edad"> </div> 
    <hr class="p-1">

    <div class="row row-cols-4">
        <div class="col">
            <div class="form-group">
            <label class="small" for="tipos_factura">Tipo Identificación Acompañante</label>
            
                <select class="form-control" id="tipos_factura" name="tipos_factura" value="{{old('tipos_factura')}}">
                    <option value="1" selected>CC-Cedula Ciudadanía</option>
                    @foreach ($tiposid as $tiposidItem)
                        <option value="{{$tiposidItem->id}}"> {{$tiposidItem->codtipoid . "-" . $tiposidItem->tipoid}}</option> 
                    @endforeach
                </select>
                
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="small" for="cedulaa">Identificación Acompañante</label>
                <input type="number" class="form-control historia borra" id="cedulaa" name="cedulaa"  value="{{old('cedulaa')}}"  >
                
                {!! $errors->first('cedulaa','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                {!! $errors->first('edad','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}                
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="small" for="prinoma">Acompañante</label>
                <input type="text" class="form-control borra" name="prinoma" value="{{old('prinoma')}}" readonly>
                {!! $errors->first('prinomh','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="small" for="priapea"></label>
                <input type="text" class="form-control borra" name="priapea" value="{{old('priapea')}}" readonly>
                {!! $errors->first('priapeh','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col">
            <div class="form-group">
                
                <textarea class="form-control borra" Placeholder="Anamnesis" name="anamnesis" style="height: 50px">{{old('anamnesis')}}</textarea>
                {!! $errors->first('anamnesis','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                
            </div>            
        </div>
    </div>
    <div class="row align-items-left ">
        <div class="col col-sm-auto">
            
                <label class="small" style="width: 50px">AV SC VL </label>
                
            
        </div>        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="avscvlod">OD </label>
                <input type="text" class="form-control borra m-1" name="avscvlod" style="width: 100px" value="{{old('avscvlod')}} ">
                {!! $errors->first('avscvlod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small"for="avscvloi">OI</label>
                <input type="text" class="form-control borra m-1" name="avscvloi" style="width: 100px" value="{{old('avscvloi')}} ">
                {!! $errors->first('avscvlod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>

        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" style="width: 100px" for="vpod">VP OD</label>
                <input type="text" class="form-control borra m-1" name="vpod" style="width: 100px" value="{{old('vpod')}} ">
                {!! $errors->first('vpod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" style="width: 50px" for="vpoi">VP OI</label>
                <input type="text" class="form-control borra m-1" name="vpoi" style="width: 100px" value="{{old('vpoi')}} ">
                {!! $errors->first('vpoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>                 
    
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small"  for="ao">AO</label>
                <input type="text" class="form-control borra m-1" name="ao" style="width: 100px" value="{{old('ao')}} ">
                {!! $errors->first('ao','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>  
        <div class="col col-sm-auto">
            <div class="form-group">
                <label class="small">EXM EXT</label>
                
            </div>            
        </div>
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="exmextod">OD</label>
                <input type="text" class="form-control borra m-1" name="exmextod" style="width: 100px" value="{{old('exmextod')}} ">
                {!! $errors->first('exmextod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" for="exmextoi">OI</label>
                <input type="text" class="form-control borra m-1" name="exmextoi" style="width: 100px" value="{{old('exmextoi')}} ">
                {!! $errors->first('exmextoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>              
    </div>

    <hr class="p-1">
    <div class="row align-items-left ">
        <div class="col col-sm-auto">
                <label class="small" style="width: 50px">CONVERT TEST</label>
        </div>        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="convinf">INF </label>
                <input type="text" class="form-control borra m-1" name="convinf" style="width: 100px" value="{{old('convinf')}} ">
                {!! $errors->first('convinf','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small"for="convdp">DP</label>
                <input type="text" class="form-control borra m-1" name="convdp" style="width: 95px" value="{{old('convdp')}} ">
                {!! $errors->first('convdp','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>

        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" style="width: 95px" for="cms">40 CMS</label>
                <input type="text" class="form-control borra m-1" name="cms" style="width: 100px" value="{{old('cms')}} ">
                {!! $errors->first('cms','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" style="width: 50px" for="ppc">PPC</label>
                <input type="text" class="form-control borra m-1" name="ppc" style="width: 100px" value="{{old('ppc')}} ">
                {!! $errors->first('ppc','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>                 
    
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small"  for="tcolod">TEST COLOR OD</label>
                <input type="text" class="form-control borra m-1" name="tcolod" style="width: 100px" value="{{old('tcolod')}} ">
                {!! $errors->first('tcolod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" for="tcoloi">TEST COLOR OI</label>
                <input type="text" class="form-control borra m-1" name="tcoloi" style="width: 100px" value="{{old('tcoloi')}} ">
                {!! $errors->first('tcoloi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>              
    </div>

    <hr class="p-1">
    <div class="row align-items-left ">
        <div class="col col-sm-auto">
            
                <label class="small" style="width: 50px">SIST MUSCULAR</label>
                
            
        </div>        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="smod">OD</label>
                <input type="text" class="form-control borra m-1" name="smod" style="width: 100px" value="{{old('smod')}} ">
                {!! $errors->first('smod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small"for="smoi">OI</label>
                <input type="text" class="form-control borra m-1" name="smoi" style="width: 100px" value="{{old('smoi')}} ">
                {!! $errors->first('smoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>

        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small small" style="width: 100px" for="test">TEST STERE- OPSIS</label>
                <input type="text" class="form-control borra m-1" name="test" style="width: 95px" value="{{old('test')}} ">
                {!! $errors->first('test','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" for="pris">PRISMAS</label>
                <input type="text" class="form-control borra m-1" name="pris" style="width: 95px" value="{{old('pris')}} ">
                {!! $errors->first('pris','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>                 
        <div class="col col-sm-auto">
                <label class="small" style="width: 50px">OFTAL-MOSCOPIA</label>
        </div> 
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="ofod">OD</label>
                <input type="text" class="form-control borra m-1" name="ofod" style="width: 100px" value="{{old('ofod')}} ">
                {!! $errors->first('ofod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" for="ofoi">OI</label>
                <input type="text" class="form-control borra m-1" name="ofoi" style="width: 100px" value="{{old('ofoi')}} ">
                {!! $errors->first('ofoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>              
    </div>

    <hr class="p-1">
    <div class="row align-items-left ">
        <div class="col col-sm-auto">
            
                <label class="small" style="width: 50px">QUERATO-METRIA</label>
                
            
        </div>        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="qod">OD</label>
                <input type="text" class="form-control borra m-1" name="qod" style="width: 100px" value="{{old('qod')}} ">
                {!! $errors->first('qod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small"for="qoi">OI</label>
                <input type="text" class="form-control borra m-1" name="qoi" style="width: 100px" value="{{old('qoi')}} ">
                {!! $errors->first('qoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>
             
        <div class="col col-sm-auto">
                <label class="small" style="width: 50px">TONO- METRIA</label>
        </div> 
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="tonod">OD</label>
                <input type="text" class="form-control borra m-1" name="tonod" style="width: 100px" value="{{old('tonod')}} ">
                {!! $errors->first('tonod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" style="width: 50px" for="tonoi">OI</label>
                <input type="text" class="form-control borra m-1" name="tonoi" style="width: 100px" value="{{old('tonoi')}} ">
                {!! $errors->first('tonoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>              
        <div class="col col-sm-auto">
            <label class="small"style="width: 50px" >REFRACC DINAMICA</label>
    </div> 
    <div class="col col-sm-auto">
        <div class="input-group input-group-sm mb-3">
            
            <label class="small" for="refdimod">OD</label>
            <input type="text" class="form-control borra m-1" name="refdimod" style="width: 100px" value="{{old('refdimod')}} ">
            {!! $errors->first('refdimod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
        </div>            
    </div>
    
    <div class="col col-sm-auto">
        <div class="input-group input-group-sm mb-3">

            <label class="small" for="refdimoi">OI</label>
            <input type="text" class="form-control borra m-1" name="refdimoi" style="width: 100px" value="{{old('refdimoi')}} ">
            {!! $errors->first('refdimoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
        </div>       
    </div>                      
    </div>

    <hr class="p-1">

    <div class="row align-items-left ">
        <div class="col col-sm-auto">
            
                <label class="small" style="width: 50px">REFRACCI ESTATICA</label>
                
            
        </div>        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" for="refesod">OD </label>
                <input type="text" class="form-control borra m-1" name="refesod" style="width: 100px" value="{{old('refesod')}} ">
                {!! $errors->first('refesod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small"for="refesoi">OI</label>
                <input type="text" class="form-control borra m-1" name="refesoi" style="width: 100px" value="{{old('refesoi')}} ">
                {!! $errors->first('refesoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>

        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" style="width: 100px" for="subod">SUBJ OD</label>
                <input type="text" class="form-control borra m-1" name="subod" style="width: 100px" value="{{old('subod')}} ">
                {!! $errors->first('subod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" style="width: 50px" for="suboi">SUBJ OI</label>
                <input type="text" class="form-control borra m-1" name="suboi" style="width: 100px" value="{{old('suboi')}} ">
                {!! $errors->first('suboi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>                 
 

        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">
                
                <label class="small" style="width: 50px" for="rxod">RX FINAL OD</label>
                <input type="text" class="form-control borra m-1" name="rxod" style="width: 100px" value="{{old('rxod')}} ">
                {!! $errors->first('rxod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>            
        </div>
        
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" for="rxoi">OI</label>
                <input type="text" class="form-control borra m-1" name="rxoi" style="width: 100px" value="{{old('rxoi')}} ">
                {!! $errors->first('rxoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>    
    
        <div class="col col-sm-auto">
            <div class="input-group input-group-sm mb-3">

                <label class="small" for="add">ADD</label>
                <input type="text" class="form-control borra m-1" name="add" style="width: 100px" value="{{old('add')}} ">
                {!! $errors->first('add','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>       
        </div>                   
    </div>
    LENSOMENTRIA
    <div class="container-sm">
        <div class="row justify-content-md-center">
            <div class="col border border-2"></div>
            <div class="col small border border-2 ">ESF</div>
            <div class="col small border border-2 ">CIL</div>
            <div class="col small border border-2 ">EJE</div>
            <div class="col small border border-2 ">ADD</div>
            <div class="col small border border-2 ">AV</div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col small border border-2">OD</div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="esfod" value="{{old('esfod')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('esfod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="cilod" value="{{old('cilod')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('cilod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="ejeod" value="{{old('ejeod')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('ejeod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="addod" value="{{old('addod')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('addod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="avod" value="{{old('avod')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('avod','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>            
        </div>
        <div class="row justify-content-md-center">
            <div class="col small border border-2">OI</div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="esfoi" value="{{old('esfoi')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('esfoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="ciloi" value="{{old('ciloi')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('ciloi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="ejeoi" value="{{old('ejeoi')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('ejeoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="addoi" value="{{old('addoi')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('addoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>
            <div class="col border border-2">            
                <div class="input-group input-group-sm m-1">
                <input type="text" class="form-control borra" name="avoi" value="{{old('avoi')}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                {!! $errors->first('avoi','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                </div>
            </div>            
        </div>
    </div>
    <br>

    <div class="row row-cols-4">
        <div class="col">
            <div class="form-group">
            <label for="cie10id_id">DX Principal</label>
                @php echo $obj @endphp
                
                {!! $errors->first('cie10id_id','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
            </div>
        </div>
        <div class="col">
            <div class="form-group">
            <label for="cie10id_id2">DX Secundario</label>
                @php echo $obj @endphp
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                
                <textarea class="form-control borra" Placeholder="Conducta" name="conducta" style="height: 50px">{{old('conducta')}}</textarea>
                {!! $errors->first('conducta','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                
            </div>            
        </div>
    </div>
    <div class="row row-cols-4"><div class="col">
        
        <button type="submit" class="btn btn-primary" >Guardar</button>
        </div><div class="col">
            <input type="reset" class="btn btn-light" id="limpia" value="Limpiar" onclick=limpiar()>
            
        
    </div></div>
</div>

