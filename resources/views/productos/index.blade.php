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
                                <div class="container">
                                    <div id = "form-errorspp"></div>
                                    <div class="row">
                                        <div class="col">
                                            <h1>Listado de Productos</h1>
                                        </div>
                                        <button type="button" class="btn btn-success" onclick="limpiar();$('#exampleModal').modal();">Crear Producto</button>
                                    </div>
                                    <br>
                                    <table class="table table-sm ">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Es Lente</th>
                                                <th scope="col">Valor</th>
                                                <th scope="col">Fecha Creación</th>
                                                <th scope="col">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($productos as $producto)
                                            <tr class="{{$producto->activo?'table-light':'table-danger'}}">
                                                
                                                <td>{{ucfirst(strtolower($producto->nombre))}}</td> 
                                                <td>{{$producto->lente?'Si':'No'}}</td>
                                                <td >{{number_format($producto->valor)}}</td>
                                                <td>{{date_format($producto->created_at,"d/m/Y")}}</td>
                                                    <td>
                                                        @if (count($producto->detfacturas)<=0)
                                                            <button type="button" value="{{$producto->id}}" onclick="elimina(this)" class="btn btn-danger btn-sm float-center"><i class="far fa-trash-alt" title="Eliminar"></i></button>
                                                        @else
                                                            <button type="button" value="{{$producto->id}}" onclick="desactiva(this)" class="btn btn-danger btn-sm float-center"><i class="far fa-trash-alt" title="Desactivar"></i></button>
                                                        @endif
                                                        <button type="button" value="{{$producto->id}}" onclick="modproducto(this)" class="btn btn-info btn-sm float-center"><i class="far fa-edit" title="Actualizar"></i></button>
                                                    </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3"><h1>No existen productos.</h1></td></tr>
                                        @endforelse                                    
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="rutaexiste" value="{{ route('productos.existe') }}">
                                    <input type="hidden" id="rutaborra" value="{{ route('productos.elimina') }}">
                                    <input type="hidden" id="rutades" value="{{ route('productos.desactiva') }}">
                                @if ($productos->count())
                                    <div class="mt-3">
                                        {{$productos->links()}}
                                    </div>
                                @endif

                                <form id="fproducto" onkeydown="return event.key != 'Enter';">                
      
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div id = "form-errors"></div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre Producto</label>
                                                        <input type="text" class="form-control paramay" name="nombre" >
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="valor">Valor Costo del Producto</label>
                                                        <input type="number" class="form-control paramay" name="valor" >
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="lente">Lentes ?</label>
                                                        <select class="form-select" name="lente" required>
                                                            <option value="0" selected>NO</option>
                                                            <option value="1">SI</option>
                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" >
                                        </div>
                                        <input type="hidden" id="rutaactprod" value="{{ route('productos.actualiza') }}">
                                        <input type="hidden" id="rutacreaprod" value="{{ route('productos.crea') }}">

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
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
    <script src="{{asset('js/productos.js')}}"></script>
</x-app-layout>

