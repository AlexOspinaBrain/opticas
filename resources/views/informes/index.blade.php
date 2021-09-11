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
                                <x-navverticalinfo/>
                            </div>
                            <div class="col-10">
                                <div class="container-fluid">
                                    <h1>Información RIPS</h1>
                                    <div id="form-errorsrips">

                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <br>
                                    <div class="float">
                                    <form class="row g-3" id="formrips" action="{{route('informes.infrips')}}" method="post">
                                        @csrf
                                        <div class="col-auto">
                                            <div class="form-group">
                                                
                                                <input type="numeric" maxlength="4" class="form-control" 
                                                    name="ano" placeholder="Año a reportar" value="{{old('ano')}}" required>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            
                                                <select class="form-control" id="meses" name="meses" value="{{old('meses')}}" required>
                                                    <option hidden selected>Mes a reportar.....</option>
                                                    
                                                    @for ($i=1; $i<=sizeof($meses); $i++)
                                                        <option value="{{$i}}"> {{$meses[$i-1]}}</option> 
                                                    @endfor
                                                </select>
                                                
                                            </div>
                                        <div class="col-auto">
                                            <input type="hidden" id="rutainfrips" value="{{route('informes.infrips')}}">
                                          <button type="submit" class="btn btn-primary mb-3">Generar</button>
                                        </div>
                                      </form>
                                      </div>
                                      <br>
                                      <div class="row">
                                      <div id="gifproc" class="col"> 
                                        <img src="{{asset('img/Spinner.gif')}}" class="img-fluid">
                                      </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jsrips.js')}}"></script>


</x-app-layout>
