$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
}); 

//confirma la factura
$('#ffactura').on("submit",function(){
    
    event.preventDefault();

    var rutacffac = $("#rutacffac").val()

    $.ajax({
        url:rutacffac,
        data:$(this).serialize(),
        method:'put',
        success: function (data) {
            if(data.success){
                $('input[name=confirmada]').val("OK");
                
                disableElements($('#detallefactura').children());

                $('#form-errorsfac').empty();
                alert('Factura Confirmada, puede imprimirla');
                
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
                $( '#form-errorsfac' ).html( errorsHtml ); 
                
                console.clear();
            }
        }
            
        
    });
                        
});


//inserta item a la factura
$('#fprod').on("submit",function(){
    
    event.preventDefault();

    rutaprod=$("#rutaprod").val();
    dataString = {facturasid_id: $('input[name=id]').val(), productosid_id: $('#productos option:selected').val(), cantidad: $('input[name=cantidad]').val()};
    $.ajax({
        url:rutaprod,
        data:dataString,
        method:'post',
        success: function (data) {
            if(data.success){
                var stropt='<tr scope="row" class="borra"><th>' + data.serie + '</th><td>' 
                    + data.nomprod + '</td><td>' + data.detfactura.valoritem + '</td><td>' 
                    + data.detfactura.cantidad + '</td><td>' + data.detfactura.valortotitem + '</td>'
                    + '<td>';
                    if (data.nomprod == 'LENTES')
                        stropt = stropt + '<button value="'+data.detfactura.id+'" OnClick="abremodallente(this);" class="btn btn-info btn-sm  float-right"><i class="far fa-edit"></i><button>';
                    if (data.nomprod != 'CONSULTA')
                    stropt = stropt + '<button value="'+data.detfactura.id+'" OnClick="eliminaitem(this);" class="btn btn-danger btn-sm mx-sm-3 float-right"><i class="far fa-trash-alt"></i><button></tr>';
                $('#contenidofac').append(stropt)
                $('input[name=total]').val(data.valfactura);
                $('input[name=abono]').val(data.abono);
                $('#saldo').val(data.valfactura - data.abono);
                $('#form-errorsfac').empty();
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
                $( '#form-errorsitem' ).html( errorsHtml ); 
                
                console.clear();
            }
        }
    });
});

//elimina item de la factura
function eliminaitem(btn){
    
    
    var urldel = $("#rutadelete").val()
    var rutadel =  urldel.replace('temp', btn.value)
    $.ajax({
        url:rutadel,
        method:'delete',
        
        success: function (data) {
            if(data.success=="success"){
                
                alert('Item eliminado');
                
                $('input[name=total]').val(data.valfactura);
                $('input[name=abono]').val(data.abono);
                $('#saldo').val(data.valfactura - data.abono);
                $("tr").remove(".borra");
                $.each(data.detfactura, function(idx, opt) {
                    var incc = idx+1;

                        var stropt='<tr scope="row" class="borra"><th>' + incc + '</th><td>' 
                        + opt.productos.nombre + '</td><td>' + opt.valoritem + '</td><td>' 
                        + opt.cantidad + '</td><td>' + opt.valortotitem + '</td>'
                        + '<td>';
                        if (opt.productos.nombre == 'LENTES')
                            stropt = stropt + '<button value="'+opt.id+'" OnClick="abremodallente(this);" class="btn btn-info btn-sm  float-right"><i class="far fa-edit"></i><button>';
                        if (opt.productos.nombre != 'CONSULTA')
                        stropt = stropt + '<button value="'+opt.id+'" OnClick="eliminaitem(this);" class="btn btn-danger btn-sm mx-sm-3 float-right"><i class="far fa-trash-alt"></i><button></tr>';
                        $('#contenidofac').append(stropt)                        
                });
            }else
                alert('El item no pudo ser eliminado, vuelva a consultar la factura')
        }
    });
}

//guarda datos cliente
$('#fcliente').on("submit",function(){
    
    event.preventDefault();

    $rutancli=$("#rutancli").val();
    $('input[name=_method]').remove();
    $('input[name=vmodal]').val("vmodal");
    

    $.ajax({
        url:$rutancli,
        data:$(this).serialize(),
        method:'post',
        success: function (data) {
            if(data.success){
                alert('Cliente guardado con exito!')
                //lleva datos a la factura
                $('#form-errorsfac').empty();
                $('#tiposid_idb').val(data.cliente.tiposid_id);
                $('#cedulab').val(data.cliente.cedula);
                $('input[name=priapeb]').val(data.cliente.priape);
                $('input[name=prinomb]').val(data.cliente.prinom);
                $('input[name=clienteid_id]').val(data.cliente.id);
                
                $rutanfact=$("#rutanfact").val()
                $.ajax({
                    url:$rutanfact,
                    data:{'clienteid_id':data.cliente.id},
                    dataType:'json',
                    method:'post',
                    //crea una factura para el cliente
                    success: function (responsefn) {
                            if(responsefn.factura != null){    
                                $('input[name=id]').val(responsefn.factura.id);
                            }
                    }
                });
                
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

$('#cedulab').on("blur",function(){
    if($('#cedulab').val().trim().length < 1){
        limpiar();
    }

});

//busca si existe el cliente y si tiene facturas pendientes
$('#fseclie').on("submit",function(){
    if($('#cedulab').val().trim().length > 0)
    {
        event.preventDefault();
        
        $("tr").remove(".borra");
        enableElements($('#detallefactura').children());
        $('input[name=confirmada]').val("")
        
        var $tipo = $('#tiposid_idb').val();
        var $numero = $('#cedulab').val();

        var rutabusca = $('#rutabusca').val();

        $.ajax({
            url:rutabusca,
            data:{'tipo':$tipo,'numero':$numero},
            dataType:'json',
            method:'post',
            success: function (response) {
                //si no existe el cliente
                if(!response || response.user==null){    
                    $('input[name=prinomb]').val("")
                    $('input[name=priapeb]').val("")
                    $('input[name=id]').val("")
                    $('input[name=clienteid_id]').val("")
                    $('input[name=total]').val(0);
                    $('input[name=abono]').val(0);
                    $('#saldo').val(0);
                    $("tr").remove(".borra");

                    //abre el modal para crear cliente
                    $('#exampleModal').modal();
                    $("#cedula").val($numero);
                    $("#tiposid_id").val($tipo);
                    $("#cedula").attr("readonly",true);
                    $("#tiposid_id").attr("readonly",true);

                    
                }else{
                    //el cliente existe--- lleva datos a la factura
                    $('input[name=clienteid_id]').val(response.user.id);
                    $('input[name=prinomb]').val(response.user.prinom);
                    $('input[name=priapeb]').val(response.user.priape);
                    $('input[name=id]').val("")
                 
                    var rutaclifac=$("#rutaclifac").val()
                    $.ajax({
                        url:rutaclifac,
                        data:{'cliente':response.user.id},
                        dataType:'json',
                        method:'post',
                        //si tiene facturas pendientes trae la info
                        success: function (responsef) {
                                if(responsef.factura != null){    
                                    $('input[name=id]').val(responsef.factura.id);
                                    $('input[name=total]').val(responsef.factura.total);
                                    $('input[name=abono]').val(responsef.factura.abono);
                                    $('#saldo').val(responsef.factura.total - responsef.factura.abono);

                                    $.each(responsef.detfactura, function(idx, opt) {
                                        var incc = idx+1;

                                            var stropt='<tr scope="row" class="borra"><th>' + incc + '</th><td>' 
                                            + opt.productos.nombre + '</td><td>' + opt.valoritem + '</td><td>' 
                                            + opt.cantidad + '</td><td>' + opt.valortotitem + '</td>'
                                            + '<td>';
                                            if (opt.productos.nombre == 'LENTES')
                                                stropt = stropt + '<button value="'+opt.id+'" OnClick="abremodallente(this);" class="btn btn-info btn-sm  float-right"><i class="far fa-edit"></i><button>';
                                            if (opt.productos.nombre != 'CONSULTA')
                                            stropt = stropt + '<button value="'+opt.id+'" OnClick="eliminaitem(this);" class="btn btn-danger btn-sm mx-sm-3 float-right"><i class="far fa-trash-alt"></i><button></tr>';
                                            $('#contenidofac').append(stropt)                                             
                                    });
                                }else{
                                    
                                    $rutanfact=$("#rutanfact").val()
                                    cliente=$('input[name=clienteid_id]').val()
                                    $.ajax({
                                        url:$rutanfact,
                                        data:{'clienteid_id':cliente},
                                        dataType:'json',
                                        method:'post',
                                        //crea una factura para el cliente
                                        success: function (responsefn) {
                                                if(responsefn.factura != null){    
                                                    $('input[name=id]').val(responsefn.factura.id);
                                                }
                                        }
                                    });

                                    $('input[name=total]').val(0);
                                    $('input[name=abono]').val(0);
                                    $('#saldo').val(0);
                                    $("tr").remove(".borra");
                                }
                        },
                    });
                }
            },
            error: function() {
                alert('Fallo en la consulta, intente de nuevo.');
                }
        });
    }
 });


function limpiar(){

    $('input[name=prinomb]').val("")
    $('input[name=priapeb]').val("")
    $('input[name=id]').val("")
    $('input[name=clienteid_id]').val("")
    $('input[name=total]').val(0);
    $('input[name=abono]').val(0);
    $('#saldo').val(0);
    $("tr").remove(".borra");
    $('#form-errorsfac').empty();
    enableElements($('#detallefactura').children());
    $('input[name=confirmada]').val("")
};

$('#impfac').on("click",function(){
    var div = document.querySelector("#vimprimir");
    imprimirElemento(div);
});

$("#pdf").on ("click",function(){
    if ($('input[name=confirmada]').val() == "OK"){
        var rutaimp = $('#rutaimpr').val();

        $.ajax({
            url:rutaimp,
            data:{id:$('input[name=id]').val()},
            dataType:'html',
            method:'get',
            success: function (response) {
                
                $("#facturaModal .modal-body").html(response)
                $("#facturaModal").modal()
                
            },
            
        });

    }    
    else
        alert("Factura sin confirmar")
    
})

$('#flentes').on("submit",function(){
    event.preventDefault();
    
    var rutaglente = $('#rutaglente').val();

    $.ajax({
        url:rutaglente,
        data:$(this).serialize(),
        dataType:'json',
        method:'post',
        success: function (response) {
            alert('Registro guardado')
            limpiamodallente()
            $('#lentesModal').modal('hide');
        }
    });
})

function abremodallente(btn){
    $('input[name=detfacturasid_id]').val(btn.value);

    var rutablente = $('#rutablente').val();

    $.ajax({
        url:rutablente,
        data:{'id':btn.value},
        dataType:'json',
        method:'post',
        success: function (response) {
            limpiamodallente()
            if(response.existe == true){    
                $('input[name=lesferaod]').val(response.detfaclente.lesferaod);
                $('input[name=lesferaoi]').val(response.detfaclente.lesferaoi);
                $('input[name=lcilindroi]').val(response.detfaclente.lcilindroi);
                $('input[name=lcilindrod]').val(response.detfaclente.lcilindrod);
                $('input[name=lejei]').val(response.detfaclente.lejei);
                $('input[name=lejed]').val(response.detfaclente.lejed);
                $('input[name=laddi]').val(response.detfaclente.laddi);
                $('input[name=laddd]').val(response.detfaclente.laddd);
                $('input[name=ldpi]').val(response.detfaclente.ldpi);
                $('input[name=ldpd]').val(response.detfaclente.ldpd);
                $('input[name=cesferaoi]').val(response.detfaclente.cesferaoi);
                $('input[name=cesferaod]').val(response.detfaclente.cesferaod);
                $('input[name=ccilindroi]').val(response.detfaclente.ccilindroi);
                $('input[name=ccilindrod]').val(response.detfaclente.ccilindrod);
                $('input[name=cejei]').val(response.detfaclente.cejei);
                $('input[name=cejed]').val(response.detfaclente.cejed);
                $('input[name=caddi]').val(response.detfaclente.caddi);
                $('input[name=caddd]').val(response.detfaclente.caddd);
                $('input[name=cdpi]').val(response.detfaclente.cdpi);
                $('input[name=cdpd]').val(response.detfaclente.cdpd);
            }
        }
    })

    $('#lentesModal').modal()
}

function limpiamodallente(){
    $('input[name=lesferaod]').val("")
    $('input[name=lesferaoi]').val("")
    $('input[name=lcilindroi]').val("")
    $('input[name=lcilindrod]').val("")
    $('input[name=lejei]').val("")
    $('input[name=lejed]').val("")
    $('input[name=laddi]').val("")
    $('input[name=laddd]').val("")
    $('input[name=ldpi]').val("")
    $('input[name=ldpd]').val("")
    $('input[name=cesferaoi]').val("")
    $('input[name=cesferaod]').val("")
    $('input[name=ccilindroi]').val("")
    $('input[name=ccilindrod]').val("")
    $('input[name=cejei]').val("")
    $('input[name=cejed]').val("")
    $('input[name=caddi]').val("")
    $('input[name=caddd]').val("")
    $('input[name=cdpi]').val("")
    $('input[name=cdpd]').val("")
}