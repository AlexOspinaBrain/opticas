<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div  class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div  class="p-6 sm:px-10 bg-white border-b border-gray-200">

                    <div class="mt-1 text-gray-500">
                        <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                            <form id="fseclie" class="form">
                            @csrf
                                
                                <div class="row border mb-1 bg-light px-1 p-2 align-items-end">
                                    <div class="form-group" >
                                        <select class="form-control mx-sm-3 mb-2" id="tiposid_idb" >
                                            <option value="1" selected>CC-Cedula Ciudadanía</option>
                                            @foreach ($tiposid as $tiposidItem)
                                                <option value="{{$tiposidItem->id}}"> {{$tiposidItem->codtipoid . "-" . $tiposidItem->tipoid}}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2" >
                                        <input type="number" class="form-control historia" id="cedulab" placeholder="Identificación a buscar"required>
                                    </div>
                                    <input type="hidden" id="rutabusca" value="{{ route('clienteexiste') }}">
                                    <input type="hidden" id="rutaclifac" value="{{ route('clienteconfactura') }}">
                                    
                                    <button type="submit" class="btn btn-primary mb-2" >Busca Cliente</button>
                                    
                                </div>
                            </form>
                            
                            
                            <h6 class="h6">Facturación :</h6>
                            <div id="form-errorsfac"></div>
                            <form id="ffactura">
                                <div class="row border mb-1 bg-light px-1 p-2">
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            
                                            <input type="text" class="form-control" name="prinomb" value="{{old('prinomb')}}" placeholder="Nombre Cliente" readonly>
                                            {!! $errors->first('prinomh','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-2">
                                            
                                            <input type="text" class="form-control" name="priapeb" value="{{old('priapeb')}}" placeholder="Apellido Cliente" readonly>
                                            {!! $errors->first('priapeh','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row border mb-1 bg-light px-1 p-2 align-items-end">
                                    <div class="form-group col" >
                                        <label for="subtotal">Total</label>
                                        <input type="text" class="form-control" name="total" readonly value="{{old('total',0)}}">
                                    </div>
                                    <div class="form-group col">
                                        <label for="segape">Abono</label>
                                        <input type="text" class="form-control" name="abono" value="{{old('abono',0)}}">
                                    </div>
                                    <div class="form-group col">
                                        <label for="segape">Saldo</label>
                                        <input type="text" class="form-control" id="saldo" readonly value=0>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" >Confirmar factura</button>
                                    </div>
                                </div>
                                <div>
                                    <input type="hidden" name="id" value="{{old('id')}}"/> 
                                    <input type="hidden" name="clienteid_id" value="{{old('clienteid_id')}}"/> 
                                    <input type="hidden" name="idusers_id" value="{{auth()->id()}}">
                                    <input type="hidden" name="confirmada" value="">
                                    <input type="hidden" id="rutacffac" value="{{ route('actualizafactura') }}">
                                    
                                </div>
                            </form>
                            <button type="button" class="btn btn-info btn-sm mb-2" id="pdf">Imprimir</button>    
                        </div>
                        
                        <div class="col mx-sm-3" id="detallefactura">
                            <h6 class="h6">Item Factura :</h6>
                            <div id="form-errorsitem"></div>
                            <form id="fprod" class="form-inline">
                                @csrf
                                    
                                    <div class="row border mb-1 bg-light px-1 ">
                                        
                                        <div class="form-group" >
                                            <select class="form-control mx-sm-3 mb-2" id="productos" name="productosid_id">
                                                <option value="">Item...</option>
                                                @foreach ($producto as $productoItem)
                                                    <option value="{{$productoItem->id}}"> {{$productoItem->nombre}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2" >
                                            <input type="number" class="form-control historia sm-1" id="cantidad" name="cantidad" placeholder="Cantidad..."required>
                                        </div>
                                        <input type="hidden" id="rutaprod" value="{{ route('detallefactura') }}">
                                    
                                        <input type="hidden" id="rutadelete" value="{{ route('eliminadetallefactura', ['id' => 'temp']) }}">
                                        
                                        <button type="submit" class="btn btn-primary mb-2" >Agregar</button>

                                    </div>
                            </form>

                            <table class="table table-sm table-hover" id="detfac">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Total</th>
                                    <th scope="col" class="">Acción</th>
                                  </tr>
                                </thead>
                                <tbody id="contenidofac">

                                </tbody>
                              </table>
                        </div>   
                    </div>                    
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="fcliente" onkeydown="return event.key != 'Enter';">                
      
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Debe crear el cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-formcliente  :estciv="$estciv" :tiposid="$tiposid" :eps="$eps" :municipios="$municipio" :municipios1="$municipio1" :pais="$pais" />
                <input type="hidden" name="vmodal" value="vmodal">
                <input type="hidden" name="idusers_id" value="{{auth()->id()}}">
                
            </div>
            <input type="hidden" id="rutancli" value="{{ route('clientepost') }}">
            <input type="hidden" id="rutanfact" value="{{ route('facturacrea') }}">
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
            </div>
        </div>
        </div>
    </form>

    <div class="modal fade" id="facturaModal" tabindex="-1" aria-labelledby="facturaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="facturaModalLabel">Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="rutaimpr" value="{{ route('facimp') }}">
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <div class="row p-2"><div class="col"><button type="button" class="btn btn-primary btn-sm" id="impfac">Imprimir</button></div></div>
                <div class="row p-2"><div class="col"><button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button></div></div>
                
                
            </div>
            </div>
        </div>
    </div>

        <form id="flentes">
        <div class="modal fade" id="lentesModal" tabindex="-1" aria-labelledby="lentesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lentesModalLabel">Lentes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-lentesform />
                </div>
                <input type="hidden" id="rutablente" value="{{ route('buscalente') }}">
                <input type="hidden" id="rutaglente" value="{{ route('guardalente') }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    
                </div>
                </div>
            </div>
            </div>
        </form>
        
        <script src="{{asset('js/factura.js')}}"></script>


</x-app-layout>