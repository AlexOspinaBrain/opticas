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
                                            <h1>Listado de Historias</h1>
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
                                        @forelse ($historias as $historia)
                                            <tr class="table-light">
                                                
                                                <td>{{$historia->cliente->tiposid->tipoid}}</td>
                                                <td>{{number_format($historia->cliente->cedula)}}</td>
                                                <td>{{ucfirst(strtolower($historia->cliente->prinom)) . " ". ucfirst(strtolower($historia->cliente->segnom))}}</td> 
                                                <td>{{ucfirst(strtolower($historia->cliente->priape)) . " ". ucfirst(strtolower($historia->cliente->segape))}}</td>
                                                <td>{{date_format($historia->created_at,"d/m/Y")}}</td>
                                                <td>{{$historia->user->name}}</td>
                                                    <td>
                                                        <input type="hidden" id="rutahis" value="{{ route('historia.existe') }}">
                                                        <button type="submit" value="{{$historia->id}}" onclick="modhistoria(this)" class="btn btn-info btn-sm float-center"><i class="far fa-edit" title="Actualizar"></i></button>
                                                    </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3"><h1>No existen historias.</h1></td></tr>
                                        @endforelse                                    
                                        </tbody>
                                    </table>
                                @if ($historias->count())
                                    <div class="mt-3">
                                        {{$historias->links()}}
                                    </div>
                                @endif

                                <form id="fhistoria" onkeydown="return event.key != 'Enter';">                
      
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Historia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <x-formhistoria :obj="$obj" :tiposid="$tiposid"  />
                                            <input type="hidden" name="vmodal" value="vmodal">
                                            <input type="hidden" name="id" >
                                        </div>
                                        <input type="hidden" id="rutaacthis" value="{{ route('historias.actualiza') }}">

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
    <script src="{{asset('js/historiaact.js')}}"></script>
</x-app-layout>

