<x-app-layout>
    <x-slot name="header">

    </x-slot>
    
    <div  class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div  class="p-6 sm:px-10 bg-white border-b border-gray-200">

                    <div class="mt-1 text-gray-500">
                        <div class="row">
                            <div class="col-2 bg-light pt-3">
                                <x-navvertical/>
                            </div>
                            <div class="col-10">
                                <div class="container-fluid">
                                    
                                    <div class="row">
                                        <div class="col">
                                            <h1>Listado de Clientes</h1>
                                        </div>
                                        <div class="col">
                                            <nav class="navbar navbar-light float-right">
                                                <div class="container-fluid">
                                                <form class="d-flex">
                                                    <input name="schcedula" class="form-control me-2" type="search" placeholder="Buscar por cedula" aria-label="Search">
                                                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                                                </form>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                    <table class="table table-sm ">
                                        <thead>
                                            <tr>
                                                
                                                <th scope="col">Tipo Identificación</th>
                                                <th scope="col">Cédula</th>
                                                <th scope="col">Nombres</th>
                                                <th scope="col">Apellidos</th>
                                                <th scope="col">Fecha Creación</th>
                                                <th scope="col">Usuario</th>
                                                
                                                <th scope="col">Opciones</th>
                                            </tr>                                    
                                        </thead>
                                        <tbody>
                                        @forelse ($clientes as $cliente)
                                            <tr class="table-light">
                                                
                                                <td>{{$cliente->tiposid->tipoid}}</td>
                                                <td>{{number_format($cliente->cedula)}}</td>
                                                <td>{{ucfirst(strtolower($cliente->prinom)) . " ". ucfirst(strtolower($cliente->segnom))}}</td>
                                                <td>{{ucfirst(strtolower($cliente->priape)) . " ". ucfirst(strtolower($cliente->segape))}}</td>
                                                <td>{{date_format($cliente->created_at,"d/m/Y")}}</td>
                                                <td>{{$cliente->user->name}}</td>
                                                    <td>
                                                        <input type="hidden" id="rutabuc" value="{{ route('clienteexiste') }}">
                                                        <input type="hidden" id="rutadel" value="{{ route('clientes.delete',['id' => 'temp']) }}">
                                                        @if (@$cliente->factura->id || @$cliente->historia->id || @$cliente->detfactura->id)
                                                            <button type="submit" class="btn btn-danger btn-sm float-center" disabled><i class="far fa-trash-alt" title="Imposible eliminar"></i></button>
                                                        @else
                                                            <button type="submit" value="{{$cliente->id}}" onclick="elimina(this)" class="btn btn-danger btn-sm float-center"><i class="far fa-trash-alt" title="Eliminar"></i></button>
                                                        @endif
                                                        <button type="submit" value="{{$cliente->id}}" onclick="modcliente(this)" class="btn btn-info btn-sm float-center"><i class="far fa-edit" title="Actualizar"></i></button>
                                                    </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3"><h1>No existen clientes.</h1></td></tr>
                                        @endforelse                                    
                                        </tbody>
                                    </table>
                                @if ($clientes->count())
                                    <div class="mt-3">
                                        {{$clientes->links()}}
                                    </div>
                                @endif

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
                                            
                                        </div>
                                        <input type="hidden" id="rutancli" value="{{ route('clienteactualiza') }}">
                                        
                                        
                                        
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </form>

                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/cliente.js')}}"></script>
</x-app-layout>

