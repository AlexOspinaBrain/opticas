$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

function modusuario(btn){
    var idid = btn.value
        
    var rutabusca = $('#rutaus').val();

    $.ajax({
        url:rutabusca,
        data:{'idid':idid},
        dataType:'json',
        method:'post',
        success: function (response) {
            
            if(response.usuario){    

                //abre el modal para actualizar historia
                $('input[name=id]').val(idid)
                $('input[name=name]').val(response.usuario.name)
                $('input[name=email]').val(response.usuario.email)
        
                $('#exampleModal').modal();
            }
        },
        error: function() {
            alert('Fallo en la consulta, intente de nuevo.');
            }
    });
    
    
}

$('#fusuario').on("submit",function(){
        
    event.preventDefault();

   var wrapper = $('.modal-content');
   var fieldHTML = '<div><input type="hidden" name="_method" value="PATCH"/></div>';
   $(wrapper).append(fieldHTML);

   var rutabusca = $('#rutaacthis').val();

    $.ajax({
    url:rutabusca,
    data:$(this).serialize(),
    type:'post',
    success: function (data) {
        if(data.success){
            alert('Usuario actualizado con exito!')
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