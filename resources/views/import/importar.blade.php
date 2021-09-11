<x-app-layout>
    <x-slot name="header">

    </x-slot>
    

    <script>
        $(document).ready(function(){
            $('.custom-file-input').on('change', function(event) {
                
                var inputFile = event.currentTarget;
                $(inputFile).parent()
                    .find('.custom-file-label')
                    .html(inputFile.files[0].name);
            }); 
        });
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">   
            <div class="container">
                <div class="card bg-light mt-3">
                    <div class="card-header">
                        <span>Importar Tabla EPS</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01">Cargar nuevas EPS</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name = "file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="inputGroupFile01">Escoger archivo...</label>
                                </div>
                              </div>
                            <br>
                            <button class="btn btn-success">Importar EPS</button>
            
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="card bg-light mt-3">
                    <div class="card-header">
                        
                        @if($cie10)
                            @if($cie10!='Ok')
                                <form class="form-row align-items-center" action="{{ route('actcie10') }}" method="POST">
                                    @csrf
                                    <span>Tienes {{$cie10}} registro(s) para actualizar la Cie10...
                                    
                                    <button class="btn btn-primary btn-sm">Actualizar</button></span>
                    
                                </form>
                            @else
                                <div class="alert alert-success" role="alert">
                                    Actualización Completa - {{$cie10}}
                              </div>
                            @endif
                        @else
                            <span> Importar Tabla CIE10</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('importcie10') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01">Cargar nuevo Cie10</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="inputGroupFile01">Escoger archivo...</label>
                                </div>
                              </div>

                            
                            <br>
                            <button class="btn btn-success">Importar CIE10</button>
            
                        </form>
                    </div>
                </div>
            </div>
            <br>            
            </div>
        </div>
    </div>

</x-app-layout>
   
