var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
var urlRepventas="http://localhost/Farmacia/public/reporte/venta";
manageDataRepVentas();


///***BUSCAR EN LA TABLA */



/* manage data list */
function manageDataRepVentas() {
    $.ajax({
        dataType: 'json',
        url: urlRepventas,
        data: {page:page}
    }).done(function(data){
    	manageRowRepVenta(data.data);
    });
}
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
/* Get Page Data*/
function getPageDataRepVenta() {
	$.ajax({
    	dataType: 'json',
    	url: urlRepventas,
    	data: {page:page}
	}).done(function(data){
        
		manageRowRepVenta(data.data);
	});
}
/* Add new Proveedor table row */
function manageRowRepVenta(data) {
	var	rows = '';
	$.each( data, function( key, value ) {
	  	rows = rows + '<tr>';
	  	rows = rows + '<td>'+value.nombre+'</td>';
	  	rows = rows + '<td>'+value.fecha+'</td>';
        rows = rows + '<td>'+value.name+'</td>';
        rows = rows + '<td>'+value.cantidad+'</td>';
        rows = rows + '</tr>';

	});
	$("#ventasReportes").html(rows);
}
/* Create new Proveedor */
$(".reportesVentas").click(function(e){
    e.preventDefault();
    var form_repventas = $("#generateReporte").find("form").attr("action");
    var fecha1 = $("#generateReporte").find("input[name='fecha1']").val();
    var fecha2= $("#generateReporte").find("input[name='fecha2']").val();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_repventas,
        data:{fecha1:fecha1, fecha2:fecha2}
    }).done(function(data){
        getPageDataRepVenta();
        toastr.success('Reporte creado satisfactoriamente.', 'Success Alert', {timeOut: 5000});
    });
});
/* Remove Proveedor */
$("body").on("click",".remove-proveedors-item",function(){
    var nombre = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
    var id = $(this).parent("td").data('id');
    $("#delete-item").find("form").attr("action",url + '/' + id);
    $("#delete-item").find("input[name='nombre']").val(nombre);
    
});

$('.crud-submit-proveedor-delete').click(function(e){
    e.preventDefault();
    // var c_obj = $(this).parents("tr");
    var form_repventas = $("#delete-item").find("form").attr("action");
    $.ajax({
        dataType: 'json',
        type:'delete',
        url: form_repventas,
    }).done(function(data){
        $(".modal").modal('hide');
        // c_obj.remove();
        toastr.success('Proveedor Eliminado corectamente.', 'Success Alert', {timeOut: 5000});
        getPageDataRepVenta();
    });
});

/* Edit Post */
$("body").on("click",".edit-proveedor-item",function(){
    var id = $(this).parent("td").data('id');
    var nombre = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
    var nit = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var direccion = $(this).parent("td").prev("td").prev("td").text();
    var telefono = $(this).parent("td").prev("td").text();

    $( "#edit-item").find("input[name='nombre']").val(nombre);
    $("#edit-item").find("input[name='nit']").val(nit);
    $("#edit-item").find("textarea[name='direccion']").val(direccion);
    $("#edit-item").find("input[name='telefono']").val(telefono);
    $("#edit-item").find("form").attr("action",url + '/' + id);
});



/* Updated new Proveedor */
$(".crud-submit-proveedores-edit").click(function(e){
    e.preventDefault();
    var form_repventas = $("#edit-item").find("form").attr("action");
    var nombre = $("#edit-item").find("input[name='nombre']").val();
    var nit = $("#edit-item").find("input[name='nit']").val();
    var direccion = $("#edit-item").find("textarea[name='direccion']").val();
    var telefono = $("#edit-item").find("input[name='telefono']").val();

    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: form_repventas,
        data:{nombre:nombre, nit:nit,direccion:direccion,telefono:telefono}
    }).done(function(data){
        getPageDataRepVenta();
        $(".modal").modal('hide');
        $("#create-proveedor").find("input[name='nombre']").val(" ");
        $("#create-proveedor").find("input[name='nit']").val(" ");
        $("#create-proveedor").find("textarea[name='direccion']").val(" ");
        $("#create-proveedor").find("input[name='telefono']").val(" ");
        toastr.success('Proveedor Actualizado Correctamente.', 'Success Alert', {timeOut: 5000});
    });
});