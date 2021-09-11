$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
})

$('#gifproc').hide()

$('#formripsa').on('submit',function(){

    event.preventDefault()

    var rutainfrips = $("#rutainfrips").val()

    $('#gifproc').show()
    
    $.ajax({
        url:rutainfrips,
        data:$(this).serialize(),
        method:'post',
        success: function (data) {
            //if(data.success){
                
                alert('OK')

            //}
            $('#gifproc').hide()
        },
        //manejo de errores ajax del formulario
        error: function(jqXhr) {

            if( jqXhr.status === 401 ) //redirect if not authenticated user.
                $( location ).prop( 'pathname', '<?=route("dashboard")?>' )
            
            
            if( jqXhr.status === 422 ) {
                
                var errors = jqXhr.responseJSON
                
                var errorsHtml = '<div class="alert alert-danger borraerr"><ul>'
                $.each(errors.errors, function( key, value ) {
                errorsHtml += '<p class="text-danger">' + value[0] + '</p>'
                });            
                $( '#form-errorsrips' ).html( errorsHtml )
                
                console.clear()
            }
            $('#gifproc').hide()
        }
            
        
    })  

})

