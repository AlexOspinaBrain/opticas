$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
}); 


//busca el historia y abre modal
function modhistoria(btn) {
    var idid = btn.value
        
    var rutabusca = $('#rutahis').val();
    limpiar()
    
    $.ajax({
        url:rutabusca,
        data:{'idid':idid},
        dataType:'json',
        method:'post',
        success: function (response) {
            
            if(response.historia){    

                //abre el modal para actualizar historia


                $('input[name=clienteid_id]').val(response.historia[0].clienteid_id);
                $("#cedulah").val(response.historia[0].cliente.cedula);
                $("#tiposid_idh").val(response.historia[0].cliente.tiposid_id);
                $("select[name=tiposid_id] option[value="+ response.historia[0].cliente.tiposid_id +"]").attr("selected",true);
                $('input[name=prinomh]').val(response.historia[0].cliente.prinom);
                $('input[name=priapeh]').val(response.historia[0].cliente.priape);

                $("input[name=cliente_factura_id]").val(response.historia[0].cliente_factura_id);
                $("#cedulaa").val(response.historia[0].clientefac.cedula);
                $("#tipos_factura").val(response.historia[0].clientefac.tiposid_id);
                $("select[name=tipos_factura] option[value="+ response.historia[0].clientefac.tiposid_id +"]").attr("selected",true);
                $('input[name=prinoma]').val(response.historia[0].clientefac.prinom);
                $('input[name=priapea]').val(response.historia[0].clientefac.priape);


                $("#tipos_factura").attr("disabled",true);
                $("#cedulaa").attr("readonly",true);

                $('#tiposid_idh').attr("disabled",true);
                $("#cedulah").attr("readonly",true);

                $('textarea[name=anamnesis]').val(response.historia[0].anamnesis);
                $('textarea[name=conducta]').val(response.historia[0].conducta);

                $('input[name=cie10id_id]').val(response.historia[0].cie10id_id);
                $("select[name=cie10id_id] option[value="+ response.historia[0].cie10id_id +"]").attr("selected",true);
                $('input[name=cie10id_id2]').val(response.historia[0].cie10id_id2);
                $("select[name=cie10id_id2] option[value="+ response.historia[0].cie10id_id2 +"]").attr("selected",true);
                
                $('input[name=avscvlod]').val(response.historia[0].avscvlod);
                $('input[name=avscvloi]').val(response.historia[0].avscvloi);
                $('input[name=vpod]').val(response.historia[0].vpod);
                $('input[name=vpoi]').val(response.historia[0].vpoi);
                $('input[name=ao]').val(response.historia[0].ao);
                $('input[name=exmextod]').val(response.historia[0].exmextod);
                $('input[name=exmextoi]').val(response.historia[0].exmextoi);
                $('input[name=convinf]').val(response.historia[0].convinf);
                $('input[name=convdp]').val(response.historia[0].convdp);
                $('input[name=cms]').val(response.historia[0].cms);
                $('input[name=ppc]').val(response.historia[0].ppc);
                $('input[name=tcolod]').val(response.historia[0].tcolod);
                $('input[name=tcoli]').val(response.historia[0].tcoli);
                $('input[name=smod]').val(response.historia[0].smod);
                $('input[name=smoi]').val(response.historia[0].smoi);
                $('input[name=test]').val(response.historia[0].test);
                $('input[name=pris]').val(response.historia[0].pris);
                $('input[name=ofod]').val(response.historia[0].ofod);
                $('input[name=ofoi]').val(response.historia[0].ofoi);
                $('input[name=qod]').val(response.historia[0].qod);
                $('input[name=qoi]').val(response.historia[0].qoi);
                $('input[name=tonod]').val(response.historia[0].tonod);
                $('input[name=tonoi]').val(response.historia[0].tonoi);
                $('input[name=refdimod]').val(response.historia[0].refdimod);
                $('input[name=refdimoi]').val(response.historia[0].refdimoi);
                $('input[name=refesod]').val(response.historia[0].refesod);
                $('input[name=refesoi]').val(response.historia[0].refesoi);
                $('input[name=subod]').val(response.historia[0].subod);
                $('input[name=suboi]').val(response.historia[0].suboi);
                $('input[name=rxod]').val(response.historia[0].rxod);
                $('input[name=rxoi]').val(response.historia[0].rxoi);
                $('input[name=add]').val(response.historia[0].add);
                
                $('input[name=esfod]').val(response.historia[0].esfod);
                $('input[name=esfoi]').val(response.historia[0].esfoi);
                $('input[name=cilod]').val(response.historia[0].cilod);
                $('input[name=ciloi]').val(response.historia[0].ciloi);
                $('input[name=ejeod]').val(response.historia[0].ejeod);
                $('input[name=ejeoi]').val(response.historia[0].ejeoi);
                $('input[name=addod]').val(response.historia[0].addod);
                $('input[name=addoi]').val(response.historia[0].addoi);
                $('input[name=avod]').val(response.historia[0].avod);
                $('input[name=avoi]').val(response.historia[0].avoi);
                $('input[name=id]').val(response.historia[0].id);
                

                /*var wrapper = $('.container');
                var fieldHTML = '<div><input type="hidden" name="id" value="'+response.user.id+'"/></div>';
                $(wrapper).append(fieldHTML);
                */
        
                $('#exampleModal').modal();
            }
        },
        error: function() {
            alert('Fallo en la consulta, intente de nuevo.');
            }
    });

};

//Guarda Historia
$('#fhistoria').on("submit",function(){
        
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
            alert('Historia actualizada con exito!')
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

function limpiar(){

    $('input.borra').val(null);
    $('textarea.borra').val(null);
};