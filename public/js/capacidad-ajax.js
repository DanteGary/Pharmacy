var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageDataCap();


/* manage data list */
function manageDataCap() {
    $.ajax({
        dataType: 'json',
        url: cap,
        data: {page:page}
    }).done(function(data){

    	total_page = data.last_page;
    	current_page = data.current_page;

    	$('#pagination').twbsPagination({
	        totalPages: total_page,
	        visiblePages: current_page,
	        onPageClick: function (event, pageL) {
	        	page = pageL;
                if(is_ajax_fire != 0){
	        	  getPageDataCap();
                }
	        }
	    });

    	manageRowCap(data.data);
        is_ajax_fire = 1;
    });
}


$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});


/* Get Page Data*/
function getPageDataCap() {
	$.ajax({
    	dataType: 'json',
    	url: cap,
    	data: {page:page}
	}).done(function(data){
		manageRowCap(data.data);
	});
}


/* Add new Categories table row */
function manageRowCap(data) {
	var	rows = '';
	$.each( data, function( key, value ) {
	  	rows = rows + '<tr>';
	  	rows = rows + '<td>'+value.nombre+'</td>';
	  	rows = rows + '<td>'+value.unidadMedida+'</td>';
	  	rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#capacity-edit-item" class="btn btn-primary capacity-edit-item">Edit</button> ';
        rows = rows + '<button data-toggle="modal" data-target="#capacity-delete-item" class="btn btn-danger capacity-remove-item ">Eliminar</button> ';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';
	});
	$("#capacity").html(rows);
}


/* Create new capacidad */
$(".capacity-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-capacity").find("form").attr("action");
    var nombre = $("#create-capacity").find("input[name='nombre']").val();
    var unidadMedida = $("#create-capacity").find("input[name='unidadMedida']").val();
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{nombre:nombre,unidadMedida:unidadMedida,valor:1}
    }).done(function(data){
        getPageDataCap();
        $(".modalCap").modal('hide');
        $("#create-capacity").find("input[name='nombre']").val(" ");
        $("#create-capacity").find("input[name='unidadMedida']").val(" ");
        toastr.success('Capacidad Creado satisfactoriamente.', 'Success Alert', {timeOut: 5000});
    });
});




/* Remove Proveedor */
$("body").on("click",".capacity-remove-item",function(){
    var nombre = $(this).parent("td").prev("td").text();
    var id = $(this).parent("td").data('id');
    $("#capacity-delete-item").find("form").attr("action",cap + '/' + id);
    $("#capacity-delete-item").find("input[name='nombre']").val(nombre);
    
});

$('.capacity-submit-delete').click(function(e){
    e.preventDefault();
    // var c_obj = $(this).parents("tr");
    var form_action = $("#capacity-delete-item").find("form").attr("action");
    $.ajax({
        dataType: 'json',
        type:'delete',
        url: form_action,
    }).done(function(data){
        $(".modal").modal('hide');
        // c_obj.remove();
        toastr.success('Capacidad Eliminada corectamente.', 'Success Alert', {timeOut: 5000});
        getPageDataCap();
    });
});

/* Edit Post */
$("body").on("click",".capacity-edit-item",function(){
    var id = $(this).parent("td").data('id');
    var unidadMedida = $(this).parent("td").prev("td").text();
    var nombre = $(this).parent("td").prev("td").prev("td").text();
    $("#capacity-edit-item").find("input[name='nombre']").val(nombre);
    $("#capacity-edit-item").find("input[name='unidadMedida']").val(unidadMedida);
    $("#capacity-edit-item").find("form").attr("action",cap + '/' + id);
});



/* Updated new Proveedor */
$(".capacity-submit-edit").click(function(e){
    e.preventDefault();
    var form_action = $("#capacity-edit-item").find("form").attr("action");
    var nombre = $("#capacity-edit-item").find("input[name='nombre']").val();
    var unidadMedida = $("#capacity-edit-item").find("input[name='unidadMedida']").val();
    
    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: form_action,
        data:{nombre:nombre,unidadMedida:unidadMedida}
    }).done(function(data){
        getPageDataCap();
        $(".modal").modal('hide');
        $("#capacity-edit-item").find("input[name='unidadMedida']").val(" ");
        toastr.success('Capacidad Actualizado Correctamente.', 'Success Alert', {timeOut: 5000});
    });
});