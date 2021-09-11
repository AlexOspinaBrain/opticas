            @csrf
            <div class="container">
                <div id = "form-errors"></div>
                
                <div class="row row-cols-4">
                    <div class="col">
                        <div class="form-group">
                        <label for="tiposid_id">Tipo Identificación</label>
                            <select class="form-control" id="tiposid_id" name="tiposid_id" value="{{old('tiposid_id')}}" required tabindex="1">
                                <option value="1" selected>CC-Cédula Ciudadanía</option>
                                @foreach ($tiposid as $tiposidItem)
                                    <option value="{{$tiposidItem->id}}"> {{$tiposidItem->codtipoid . "-" . $tiposidItem->tipoid}}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="cedula">Identificación</label>
                            <input type="text" class="form-control cliente" id="cedula" name="cedula"  value="{{old('cedula')}}" required tabindex="2">
                            {!! $errors->first('cedula','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="prinom">Primer Nombre</label>
                            <input type="text" class="form-control paramay" name="prinom" value="{{old('prinom')}}" required tabindex="3">
                            {!! $errors->first('prinom','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="segnom">Segundo Nombre</label>
                            <input type="text" class="form-control paramay" name="segnom" value="{{old('segnom')}}" tabindex="4">
                            {!! $errors->first('segnom','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="priape">Primer Apellido</label>
                            <input type="text" class="form-control paramay" name="priape" value="{{old('priape')}}" required tabindex="5">
                            {!! $errors->first('priape','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="segape">Segundo Apellido</label>
                            <input type="text" class="form-control paramay" name="segape" value="{{old('segape')}}" tabindex="6">
                            {!! $errors->first('segape','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>                                                            
                </div>
                <div class="row ">
                    <div class="col">
                        <label for="ocupacion">Ocupación</label>
                        <input type="text" class="form-control paramay" name="ocupacion" value="{{old('ocupacion')}}" tabindex="7">
                        {!! $errors->first('ocupacion','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                    </div>
                    <div class="col">
                        <label for="email">Correo</label>
                        <input type="email" placeholder="Email" class="form-control paramin" name="email" value="{{old('email')}}" required tabindex="8">
                        {!! $errors->first('email','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="nacimiento">Fecha Nacimiento</label>
                            <input type="text" class="form-control date" 
                                name="nacimiento" placeholder="aaaa-mm-dd" value="{{old('nacimiento')}}" required tabindex="9">
                            {!! $errors->first('nacimiento','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>                    
                </div>
                <br>
                <div class="row row-cols-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control paramay" name="direccion" value="{{old('direccion')}}" tabindex="10">
                            {!! $errors->first('direccion','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="estadocivil_id">Estado Civil</label>
                            
                            <select class="form-control" name="estadocivil_id" value="{{old('estadocivil_id')}}" required tabindex="11">
                                
                                @foreach ($estciv as $estcivItem)
                                    <option value="{{$estcivItem->id}}"> {{ $estcivItem->estadocivil}}</option> 
                                @endforeach
                            </select>                            
                            {!! $errors->first('estadocivil_id','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="hijos">Tiene Hijos</label>
                            <select class="form-control" id="hijos" name="hijos" value="{{old('hijos')}}" required tabindex="12">
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>

                            </select>
                            
                        </div>
                    </div>
                    <div class="col">

                        <div class="form-group">
                            <label for="genero">Género</label>
                                <select class="form-control" name="genero" value="{{old('genero')}}" required tabindex="13">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>

                                </select>
                            </div>                        
                    </div>                                                            
                </div>  
                <div class="row row-cols-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" name="celular" value="{{old('celular')}}" required tabindex="14">
                            {!! $errors->first('celular','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="eps_id">EPS</label>
                            
                            <select class="form-control" name="eps_id" value="{{old('eps_id')}}" required tabindex="15">
                                
                                @foreach ($eps as $epsItem)
                                    <option value="{{$epsItem->id}}"> {{substr($epsItem->nombre,0,50) . "-" . $epsItem->codigo  }}</option> 
                                @endforeach
                            </select>
                            {!! $errors->first('eps','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="municipio_id">Municipio-Localidad</label>
                            
                            <select class="form-control" name="municipio_id" value="{{old('municipio_id')}}" required tabindex="16">
                                <option value="20">Usme - Bogotá</option>
                                @foreach ($municipios as $municipiosItem)
                                    <option value="{{$municipiosItem->id}}"> {{$municipiosItem->nomciu . "-" . $municipiosItem->nomdep  }}</option> 
                                @endforeach
                                @foreach ($municipios1 as $municipios1Item)
                                    <option value="{{$municipios1Item->id}}"> {{$municipios1Item->nomciu . "-" . $municipios1Item->nomdep  }}</option> 
                                @endforeach
                            </select>
                            {!! $errors->first('municipio_id','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="pais_id">Pais</label>
                            
                            <select class="form-control" name="pais_id" value="{{old('pais_id')}}" required tabindex="17">
                                <option value="49">Colombia</option>
                                @foreach ($pais as $paisItem)
                                    <option value="{{$paisItem->id}}"> {{$paisItem->pais   }}</option> 
                                @endforeach
                            </select>
                            {!! $errors->first('pais_id','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                        </div>
                    </div>                                                            
                </div>      
                <div><input type="hidden" name="existe" value="NO"></div>           
                <div class="row row-cols-4"><div class="col">
                    
                    <button type="submit" class="btn btn-primary" tabindex="18">Guardar</button>
                    </div><div class="col">
                        <input type="reset" class="btn btn-light" id="limpia" value="Limpiar" onclick=limpiar()>
                        
                    
                </div></div>
            </div>


