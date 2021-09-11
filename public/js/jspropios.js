$(".paramay").on("keyup", function () {
    $input=$(this);
    setTimeout(function () {
     $input.val($input.val().toUpperCase());
    },50);
   });

$(".paramin").on("keyup", function () {
    $input=$(this);
    setTimeout(function () {
     $input.val($input.val().toLowerCase());
    },50);
   });

$('.date').datepicker({
            
    format: 'yyyy-mm-dd',
    language: "es",
    autoclose: false
});    

setTimeout(function() {
  $(".instante").fadeOut(1500);
},3000);

function disableElements(el) { for (var i = 0; i < el.length; i++) { el[i].disabled = true; disableElements(el[i].children); } }
function enableElements(el) { for (var i = 0; i < el.length; i++) { el[i].disabled = false; enableElements(el[i].children); } }


function imprimirElemento(elemento) {
    var ventana = window.open('', 'PRINT', 'height=400,width=600');
    ventana.document.write('<html><head><title>' + document.title + '</title>');
    ventana.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">'); 
    ventana.document.write('</head><body >');
    ventana.document.write(elemento.innerHTML);
    ventana.document.write('</body></html>');
    ventana.document.close();
    ventana.focus();
    ventana.onload = function() {
      ventana.print();
      ventana.close();
    };
    return true;
  }

$('a[href$="' + location.pathname + '"]').addClass('active');
$('.dropdown-toggle').dropdown()