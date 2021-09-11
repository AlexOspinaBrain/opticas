$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
}); 


//busca el cliente y abre modal
function modcliente(btn) {

        var idid = btn.value
        
        var rutabusca = $('#rutabuc').val();
        limpiar()
        
        $.ajax({
            url:rutabusca,
            data:{'idid':idid},
            dataType:'json',
            method:'post',
            success: function (response) {
                
                if(response.user ){    

                    //abre el modal para actualizar cliente
                    
                    $("#cedula").val(response.user.cedula);
                    $("#tiposid_id").val(response.user.tiposid_id);
                    $("select[name=tiposid_id] option[value="+ response.user.tiposid_id +"]").attr("selected",true);
                    $('input[name=prinom]').val(response.user.prinom);


                    var wrapper = $('.container');
                    var fieldHTML = '<div><input type="hidden" name="id" value="'+response.user.id+'"/></div>';
                    $(wrapper).append(fieldHTML);

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

                    $('input[name=existe]').val("SI");
            
                    $('#exampleModal').modal();
                }
            },
            error: function() {
                alert('Fallo en la consulta, intente de nuevo.');
                }
        });
    
 };

 //Guarda Cliente
 $('#fcliente').on("submit",function(){
            
    event.preventDefault();

       var wrapper = $('.modal-content');
       var fieldHTML = '<div><input type="hidden" name="_method" value="PATCH"/></div>';
       $(wrapper).append(fieldHTML);

       var rutabusca = $('#rutancli').val();

   $.ajax({
       url:rutabusca,
       data:$(this).serialize(),
       type:'post',
       success: function (data) {
           if(data.success){
               alert('Cliente guardado con exito!')
               window.location = data.ruta
           }else{
               alert('Error al guardar, intente de nuevo!')
               $('#exampleModal').modal('hide');
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

function elimina(btn){
    
    
    var urldel= $('#rutadel').val();
    var rutadel =  urldel.replace('temp', btn.value)

    $.ajax({
        url:rutadel,
        method:'delete',
        
        success: function (data) {
            if(data.success=="success"){
                
                alert('Item eliminado');
                
                window.location = data.ruta

            }else
                alert('El cliente no pudo ser eliminado, vuelva a consultar.')
        }
    });
}



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