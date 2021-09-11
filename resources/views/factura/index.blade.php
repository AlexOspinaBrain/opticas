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
                                    @error('abono')
                                        <div class="alert alert-warning">{{ $message }}</div>
                                    @enderror
                                    <div class="row">
                                        <div class="col">
                                            <h1>Listado de Facturas</h1>
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
                                                <th scope="col">#</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Cedula</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Total</th>
                                                <th colspan="2" scope="col" align="center">Abono</th>
                                                <th scope="col">Saldo</th>
                                                <th scope="col">Confirmada</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Opciones</th>
                                            </tr>                                    
                                        </thead>
                                        <tbody>
                                        @forelse ($facturas as $factura)
                                            <tr class="{{$factura->cancelada?'table-danger':'table-light'}}">
                                                <th scope="row">{{$factura->id}}</th>
                                                <td>{{date_format($factura->created_at,"d/m/Y")}}</td>
                                                <td>{{number_format($factura->cliente->cedula)}}</td>
                                                <td>{{ucfirst(strtolower($factura->cliente->prinom)) . " ". ucfirst(strtolower($factura->cliente->priape))}}</td>
                                                
                                                <td align="right">{{number_format($factura->total)}}</td>
                                                <td align="right">
                                                    
                                                    {{number_format($factura->abono)}}
                                                </td>
                                                <td align="left">
                                                    @if (!$factura->cancelada)
                                                        @if ($factura->total > $factura->abono)
                                                            <button type="button" class="btn btn-info btn-sm float-right" value="{{$factura->id.'-'.$factura->abono}}" onclick="abremodalabono(this)">...</button>    
                                                        @endif
                                                    @endif
                                                    </div>
                                                    
                                                </td>
                                                <td align="right">{{number_format($factura->total - $factura->abono)}}</td>
                                                <td>{{ $factura->confirmada == true ? "Si" : "No" }}</td>
                                                <td>{{$factura->user->name}}</td>
                                                @if ($factura->cancelada)
                                                    <td><p>Cancelada</p></td>
                                                @else
                                                    <td><form method="POST" action="{{route('factura.update')}}">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <input type="hidden" name="idfact" value="{{$factura->id}}">
                                                        
                                                        <button type="submit" class="btn btn-danger btn-sm float-center"><i class="far fa-trash-alt" title="Eliminar"></i></button>
                                                    </form></td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr><td colspan="3"><h1>No existen facturas para este usuario.</h1></td></tr>
                                        @endforelse                                    
                                        </tbody>
                                    </table>
                                @if ($facturas->count())
                                    <div class="mt-3">
                                        {{$facturas->links()}}
                                    </div>
                                @endif


                                <form id="factabono" action="{{route('rutaabono')}}" method="POST">                
                                    @csrf
                                    @method('PUT')
                                    <div class="modal fade" id="actabonoModal" tabindex="-1" aria-labelledby="actabonoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="actabonoModalLabel">Actualiza Abono</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control paramay" name="abono" required >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <input type="hidden" id="facturaida" name="facturaida" value="">
                                        
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

</x-app-layout>


<script>
    
    function abremodalabono(btn){
        var arrps = btn.value.split('-')
        
        $('#facturaida').val(arrps[0]);
        $('input[name=abono]').val(arrps[1]);
        $('#actabonoModal').modal()
    }    


</script>