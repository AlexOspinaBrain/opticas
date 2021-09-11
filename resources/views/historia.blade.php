<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div  class="py-3">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div  class="p-6 sm:px-10 bg-white border-b border-gray-200">

                    <div class="mt-1 text-gray-500">
                        
                        @if($creado=="OK")
                            <div class="alert alert-primary instante" role="alert">
                                <span>Historia Creada con Exito!</span>
                            </div>
                        @endif
                        <form id="fhistoria" method="post" action = "{{route('historiascrea')}}" >                
                          <x-formhistoria :obj="$obj" :tiposid="$tiposid" />
                         
                        </form>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
            </div>
        </div>
        </div>
    </form>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        
        
        $('#fcliente').on("submit",function(){
            
            event.preventDefault()

            $ruta="<?=route('clientepost')?>"
            $('input[name=_method]').remove()
            $('input[name=vmodal]').attr("value","vmodal")
            $('input[name=idusers_id]').attr("value","<?=auth()->id()?>")

            $.ajax({
                url:$ruta,
                data:$(this).serialize(),
                type:'post',
                success: function (data) {
                    if(data.success){
                        alert('Cliente guardado con exito!')

                        //lleva datos a la historia
                        if ($('input[name=clienteid_id]').val()==""){
                            $('input[name=clienteid_id]').val(data.cliente.id);
                            $('input[name=prinomh]').val(data.cliente.prinom);
                            $('input[name=priapeh]').val(data.cliente.priape);
                        }else{
                            $('input[name=cliente_factura_id]').val(data.cliente.id);
                            $('input[name=prinoma]').val(data.cliente.prinom);
                            $('input[name=priapea]').val(data.cliente.priape);
                        }
                        
                        //limpia el modal
                        $("#exampleModal input").val('');
                        $("#exampleModal select").val('');
                        $("#exampleModal select option:selected").removeAttr('selected');
                        $("div").remove(".borraerr");

                        //cierra el modal
                        $('#exampleModal').modal('hide');
                    }else{
                
                        alert('Error al guardar, intente de nuevo!')
                        window.location = data.URL
                    }
                    
                },
                //manejo de errores ajax del formulario
                error: function(jqXhr) {
                    
                    if( jqXhr.status === 401 ) //redirect if not authenticated user.
                        $( location ).prop( 'pathname', '<?=route("dashboard")?>' );
                    
                    
                    if( jqXhr.status === 422 ) {
                      
                        var errors = jqXhr.responseJSON;
                        
                        var errorsHtml = '<div class="alert alert-danger borraerr"><ul>';
                        $.each(errors.errors, function( key, value ) {
                        errorsHtml += '<p class="text-danger">' + value[0] + '</p>';
                        });            
                        $( '#form-errors' ).html( errorsHtml ); 
                        
                        console.clear();
                    }
                }
            });
        

        });


        $('#cedulah.historia').on("blur",function(){
            $('input[name=cliente_id]').val(null)
            $('input[name=prinomh]').val(null)
            $('input[name=priapeh]').val(null)

            if($('#cedulah').val().trim().length > 0)
            {
                
                $tipo = $('#tiposid_idh').val()
                $numero = $('#cedulah').val()
                
                limpiarcli()

                $ruta="<?=route('clienteexiste')?>"

                $.ajax({
                url:$ruta,
                data:{'tipo':$tipo,'numero':$numero},
                dataType:'json',
                type:'post',
                success: function (response) {
                        if(!response.user || response.user==null){    
                            //abre el modal para crear cliente
                            $('#exampleModal').modal();
                            $("#cedula").val($numero);
                            $("#tiposid_id").val($tipo);
                            $("#cedula").attr("readonly",true);
                            $("#tiposid_id").attr("readonly",true);
                        }else{
                            //el cliente existe--- lleva datos a la historia
                            $('input[name=clienteid_id]').val(response.user.id);
                            $('input[name=prinomh]').val(response.user.prinom);
                            $('input[name=priapeh]').val(response.user.priape);

                            //calcula edad
                            var recnac = response.user.nacimiento.split(' ')
                            var recnac1 = recnac[0].split('-')
                            hoy=new Date()
                            edad=(hoy.getFullYear() - recnac1[0]) - 1
                            if ((hoy.getMonth() + 1) - recnac1[1] > 0){
                                edad=+1
                            }else{ 
                                if ((hoy.getMonth() + 1) - recnac1[1] == 0){
                                    if (hoy.getUTCDate() - recnac1[2] >= 0)
                                        edad=+1
                                }
                            }
                            
                            $('input[name=edad]').val(edad);
                            
                        }
                },
                error: function() {
                    alert('Fallo en la consulta, intente de nuevo.');
                    }
                });
            }
         });

         $('#cedulaa.historia').on("blur",function(){
            
            $('input[name=cliente_factura_id]').val(null)
            $('input[name=prinoma]').val(null)
            $('input[name=priapea]').val(null)
            
            if($('#cedulaa').val().trim().length > 0)
            {
                $tipo = $('#tipos_factura').val()
                $numero = $('#cedulaa').val()
    
                $ruta="<?=route('clienteexiste')?>"
                
                limpiarcli()

                $.ajax({
                url:$ruta,
                data:{'tipo':$tipo,'numero':$numero},
                dataType:'json',
                type:'post',
                success: function (response) {
                        if(!response.user || response.user ==null){    
                            //abre el modal para crear cliente
                            $('#exampleModal').modal();
                            $("#cedula").val($numero);
                            $("#tiposid_id").val($tipo);
                            $("#cedula").attr("readonly",true);
                            $("#tiposid_id").attr("readonly",true);
                        }else{
                            //el cliente existe--- lleva datos a la historia
                            $('input[name=cliente_factura_id]').val(response.user.id)
                            $('input[name=prinoma]').val(response.user.prinom)
                            $('input[name=priapea]').val(response.user.priape)
                            
                        }
                },
                error: function() {
                    alert('Fallo en la consulta, intente de nuevo.');
                }    
                });
            }
         });         




        function limpiar(){
            $('input.borra').val(null);
            $('textarea.borra').val(null);
            $('#limpia').val("Limpiar");
        }

        function limpiarcli(){

            $("#exampleModal input").val(null);
            $("#exampleModal select").val(null);

            $('select[name=hijos]').val('NO');
            $("select[name=hijos] option[value=NO]").attr("selected",true);
            
            $('select[name=genero]').val('M');
            $("select[name=genero] option[value=M]").attr("selected",true);
            
            $('select[name=pais_id]').val(49);
            $("select[name=pais_id] option[value=49]").attr("selected",true);
            
            $('select[name=municipio_id]').val(20);
            $("select[name=municipio_id] option[value=20]").attr("selected",true);
            
            $('select[name=estadocivil_id]').val(1);
            $("select[name=estadocivil_id] option[value=1]").attr("selected",true);


            
        };
    </script>
</x-app-layout>