<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div  class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div  class="p-6 sm:px-10 bg-white border-b border-gray-200">

                    <div class="mt-6 text-gray-500">
                        
                        <form id="fcliente" onkeydown="return event.key != 'Enter';">
                          <x-formcliente  :estciv="$estciv" :tiposid="$tiposid" :eps="$eps" :municipios="$municipio" :municipios1="$municipio1" :pais="$pais" />
                          <input type="hidden" name="vmodal" value="nmodal">
                          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
            }
        }); 
        
        $('#fcliente').on("submit",function(){
            
             event.preventDefault();

             

            if ($("input[name=existe]").val() == "NO"){
                $ruta="<?=route('clientepost')?>";
                $('input[name=_method]').remove();
            }else{
                
                var wrapper = $('.container');
                var fieldHTML = '<div><input type="hidden" name="_method" value="PATCH"/></div>';
                $(wrapper).append(fieldHTML);

                $ruta="<?=route('clienteactualiza')?>";
            }

            $.ajax({
                url:$ruta,
                data:$(this).serialize(),
                type:'post',
                success: function (data) {
                    if(data.success){
                        alert('Cliente guardado con exito!')
                        window.location = data.URL
                    }else{
                        alert('Error al guardar, intente de nuevo!')
                        window.location = data.URL
                    }
                    
                },
            
                error: function(jqXhr) {
                    
                    if( jqXhr.status === 401 ) //redirect if not authenticated user.
                        $( location ).prop( 'pathname', '<?=route("dashboard")?>' );
                    
                    
                    if( jqXhr.status === 422 ) {
                      
                        var errors = jqXhr.responseJSON;
                        
                        var errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each(errors.errors, function( key, value ) {
                        errorsHtml += '<p class="text-danger">' + value[0] + '</p>';
                        });            
                        $( '#form-errors' ).html( errorsHtml ); 
                        
                        console.clear();
                    }
                }
            });
        

        });
        $('#cedula').on("blur",function(){
            
            if($('#cedula').val().trim().length > 0)
            {    
                $tipo = $('#tiposid_id').val();
                $numero = $('#cedula').val();
                
                limpiar()                
                
                $('#cedula').val($numero);
                
                $ruta="<?=route('clienteexiste')?>"

                $.ajax({
                url:$ruta,
                data:{'tipo':$tipo,'numero':$numero},
                dataType:'json',
                type:'post',
                success: function (response) {
                        if(response.user){    

                            //alert(response.user.prinom)
                            
                            $('input[name=existe]').attr("value","SI");
                            var wrapper = $('.container');
                            var fieldHTML = '<div><input type="hidden" name="id" value="'+response.user.id+'"/></div>';
                            $(wrapper).append(fieldHTML);

                            $('input[name=prinom]').val(response.user.prinom);
                            $('input[name=segnom]').val(response.user.segnom);
                            $('input[name=priape]').val(response.user.priape);
                            $('input[name=segape]').val(response.user.segape);
                            
                            var formattedDate = new Date(response.user.nacimiento);
                            var d = formattedDate.getDate() < 10 ? '0' + formattedDate.getDate() : formattedDate.getDate() ;
                            var m =  formattedDate.getMonth();
                            m += 1;  // JavaScript months are 0-11
                            var mf = m < 10 ? '0' + m : m
                            var y = formattedDate.getFullYear();

                            $('input[name=nacimiento]').datepicker('setDate', new Date(mf + "/" + d + "/" + y));

                            $('input[name=ocupacion]').val(response.user.ocupacion);
                            $('input[name=email]').val(response.user.email);
                            $('select[name=eps_id]').val(response.user.eps_id);
                            $("select[name=eps_id] option[value="+ response.user.eps_id +"]").attr("selected",true);
                            $('select[name=municipio_id]').val(response.user.municipio_id);
                            $("select[name=municipio_id] option[value="+ response.user.municipio_id +"]").attr("selected",true);
                            $('select[name=pais_id]').val(response.user.pais_id);
                            $("select[name=pais_id] option[value="+ response.user.pais_id +"]").attr("selected",true);
                            $('input[name=celular]').val(response.user.celular);
                            $('input[name=direccion]').val(response.user.direccion);
                            $('select[name=estadocivil_id]').val(response.user.estadocivil_id);
                            $("select[name=estadocivil_id] option[value="+ response.user.estadocivil_id +"]").attr("selected",true);
                            
                            $('select[name=genero]').val(response.user.genero);
                            $("select[name=genero] option[value="+ response.user.genero +"]").attr("selected",true);
                            $('select[name=hijos]').val(response.user.hijos);
                            $("select[name=hijos] option[value="+ response.user.hijos +"]").attr("selected",true);
                            
                        }
                },
                error: function() {
                    alert('Fallo en la consulta, intente de nuevo.');
                    }
                });
            }
         });
    
        function limpiar(){

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

            $('input[type=text]').val(null);
            $('input[type=email]').val(null);
            $('input[name=existe]').val("NO");
            $('#limpia').val("Limpiar");
        };


    </script>
</x-app-layout>