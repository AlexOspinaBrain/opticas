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
                                            <h1>Listado de Usuarios del Sistema</h1>
                                        </div>

                                    </div>
                                    <br>
                                    <table class="table table-sm ">
                                        <thead>
                                            <tr>
                                                

                                                <th scope="col">Nombre</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Fecha Creación</th>
                                                <th scope="col">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($usuarios as $usuario)
                                            <tr class="table-light">
                                                
                                                <td>{{ucfirst(strtolower($usuario->name))}}</td> 
                                                <td>{{strtolower($usuario->email)}}</td>
                                                <td>{{date_format($usuario->created_at,"d/m/Y")}}</td>
                                                    <td>
                                                        <input type="hidden" id="rutaus" value="{{ route('usuarios.data') }}">
                                                        <button type="button" value="{{$usuario->id}}" onclick="modusuario(this)" class="btn btn-info btn-sm float-center"><i class="far fa-edit" title="Actualizar"></i></button>
                                                    </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3"><h1>No existen usuarios.</h1></td></tr>
                                        @endforelse                                    
                                        </tbody>
                                    </table>


                                <form id="fusuario" onkeydown="return event.key != 'Enter';" class="">
      
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="form-errors"></div>         
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="name">Nombre</label>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="id" >
                                        </div>
                                        <input type="hidden" id="rutaacthis" value="{{ route('usuarios.actualiza') }}">
                                        

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
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
    <script src="{{asset('js/usuarios.js')}}"></script>
</x-app-layout>

