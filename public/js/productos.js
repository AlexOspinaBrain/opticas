$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

//busca el producto y abre modal
function modproducto(btn) {
    var idid = btn.value
        
    var rutabusca = $('#rutaexiste').val();
    limpiar()
    
    $.ajax({
        url:rutabusca,
        data:{'idid':idid},
        dataType:'json',
        method:'post',
        success: function (response) {
            
            if(response.producto){   
        
                $('input[name=nombre]').val(response.producto[0].nombre);
                $('input[name=valor]').val(response.producto[0].valor);
                $('input[name=id]').val(response.producto[0].id);
                $("select[name=lente] option[value="+ response.producto[0].lente +"]").attr("selected",true);

                $('#exampleModal').modal();
            }
        },
        error: function() {
            alert('Fallo en la consulta, intente de nuevo.');
            }
    });

};                

//Guarda producto
$('#fproducto').on("submit",function(){
        
    event.preventDefault();

    if ($('input[name=id]').val()===null||$('input[name=id]').val()==""){
        var rutabusca = $('#rutacreaprod').val()
        
    }else{
        var wrapper = $('.modal-content')
        var fieldHTML = '<div><input type="hidden" name="_method" value="PATCH"/></div>'
        $(wrapper).append(fieldHTML)

        var rutabusca = $('#rutaactprod').val()
    }   

    $.ajax({
    url:rutabusca,
    data:$(this).serialize(),
    type:'post',
    success: function (data) {
        if(data.success){
            alert('Producto guardado con exito!')
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

//Desactiva producto
function desactiva(btn){
        
        var rutades = $('#rutades').val()
    
        var idid=btn.value

    $.ajax({
        url:rutades,
        data:{'idid':idid},
        type:'post',
        success: function (data) {
            if (!data.success)
                alert('Operación no procesada.')
            else
                window.location = data.ruta

        },

        error: function() {
            alert('Fallo en la consulta, intente de nuevo.');
            }
    
    });
}

//elimina producto
function elimina(btn){

    var rutabusca = $('#rutaborra').val()
    var idid = btn.value

    $.ajax({
        url:rutabusca,
        
        data:{'idid':idid},
        type:'post',
        success: function (data) {
            if(data.success){
                alert('Producto eliminado con exito!')
            }else{
                alert('Error al eliminar, intente de nuevo!')
            }
            window.location = data.ruta
        },
    
        error: function() {
            alert('Fallo en la consulta, intente de nuevo.');
            }
    });

}

function limpiar(){

    $('input[name=nombre]').val(null);
    $('input[name=id]').val(null);
    $('input[name=valor]').val('0');
    $('select[name=lente]').val('0');
    $("select[name=lente] option[value=0]").attr("selected",true);
}