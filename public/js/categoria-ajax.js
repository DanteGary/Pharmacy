var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageDataCat();
/* manage data list */
function manageDataCat() {
    $.ajax({
        dataType: 'json',
        url: cat,
        data: {page:page}
    }).done(function(data){
    	manageRowCat(data.data);
    });
}
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
/* Get Page Data*/
function getPageDataCat() {
	$.ajax({
    	dataType: 'json',
    	url: cat,
    	data: {page:page}
	}).done(function(data){
		manageRowCat(data.data);
	});
}
/* Add new Categories table row */
function manageRowCat(data) {
	var	rows = '';
	$.each( data, function( key, value ) {
	  	rows = rows + '<tr>';
	  	rows = rows + '<td>'+value.nombre+'</td>';
	  	rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#categoria-edit-item" class="btn btn-success categoria-edit-item fa fa-edit"></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#categoria-delete-item" class="btn btn-danger remove-categoria-item fa fa-trash "></button> ';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';
	});
	$("#categories").html(rows);
}
/* Create new Categoria */
$(".categories-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-categoria").find("form").attr("action");
    var nombre = $("#create-categoria").find("input[name='nombre']").val();
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{nombre:nombre,estado:0}
    }).done(function(data){
        getPageDataCat();
        $(".modal").modal('hide');
        $("#create-categoria").find("input[name='nombre']").val(" ");
        toastr.success('Categoria Creado satisfactoriamente.', 'Success Alert', {timeOut: 5000});
    });
});
/* Remove Categoria */
$("body").on("click",".remove-categoria-item",function(){
    var nombre = $(this).parent("td").prev("td").text();
    var id = $(this).parent("td").data('id');
    $("#categoria-delete-item").find("form").attr("action",cat + '/' + id);
    $("#categoria-delete-item").find("input[name='nombre']").val(nombre);
    
});
$('.categoria-submit-delete').click(function(e){
    e.preventDefault();
    // var c_obj = $(this).parents("tr");
    var form_action = $("#categoria-delete-item").find("form").attr("action");
    $.ajax({
        dataType: 'json',
        type:'delete',
        url: form_action,
    }).done(function(data){
        $(".modal").modal('hide');
        // c_obj.remove();
        toastr.success('Categoria Eliminada corectamente.', 'Success Alert', {timeOut: 5000});
        getPageDataCat();
    });
});
/* Edit Post */
$("body").on("click",".categoria-edit-item",function(){
    var id = $(this).parent("td").data('id');
    var nombre = $(this).parent("td").prev("td").text();
    $("#categoria-edit-item").find("input[name='nombre']").val(nombre);
    $("#categoria-edit-item").find("form").attr("action",cat + '/' + id);

});
/* Updated new Categoria */
$(".categoria-submit-edit").click(function(e){
    e.preventDefault();
    var form_action = $("#categoria-edit-item").find("form").attr("action");
    var nombre = $("#categoria-edit-item").find("input[name='nombre']").val();

    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: form_action,
        data:{nombre:nombre}
    }).done(function(data){
        getPageDataCat();
        $(".modal").modal('hide');
        $("#categoria-edit-item").find("input[name='nombre']").val(" ");
        toastr.success('Categoria Actualizado Correctamente.', 'Success Alert', {timeOut: 5000});
    });
});