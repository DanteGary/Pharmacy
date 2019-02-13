var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
manageDataEst();


/* manage data list */
function manageDataEst() {
    $.ajax({
        dataType: 'json',
        url: est,
        data: {page:page}
    }).done(function(data){
        manageRowEst(data.data);
    });
}
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
/* Get Page Data*/
function getPageDataEst() {
    $.ajax({
        dataType: 'json',
        url: est,
        data: {page:page}
    }).done(function(data){
        
        manageRowEst(data.data);
    });
}
/* Add new estante table row */
function manageRowEst(data) {
    var rows = '';
    $.each( data, function( key, value ) {
        rows = rows + '<tr>';
        rows = rows + '<td>'+value.nombre+'</td>';
        rows = rows + '<td>'+value.ubicacion+'</td>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-success edit-item fa fa-edit"></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#delete-item" class="btn btn-danger remove-item fa fa-trash"></button> ';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("#estante").html(rows);
}
/* Create new Estante */
$(".estante-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-estante").find("form").attr("action");
    var nombre = $("#create-estante").find("input[name='nombre']").val();
    var ubicacion = $("#create-estante").find("input[name='ubicacion']").val();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{nombre:nombre, ubicacion:ubicacion,estado:0}
    }).done(function(data){
        getPageDataEst();
        $(".modal").modal('hide');
        $("#create-estante").find("input[name='nombre']").val(" ");
        $("#create-estante").find("input[name='ubicacion']").val(" ");
    
        toastr.success('Estante Creado satisfactoriamente.', 'Success Alert', {timeOut: 5000});
    });
});
/* Remove Proveedor */
$("body").on("click",".remove-item",function(){
    var nombre = $(this).parent("td").prev("td").prev("td").text();
    var id = $(this).parent("td").data('id');
    $("#delete-item").find("form").attr("action",est + '/' + id);
    $("#delete-item").find("input[name='nombre']").val(nombre);
    
});

$('.crud-submit-delete').click(function(e){
    e.preventDefault();
    // var c_obj = $(this).parents("tr");
    var form_action = $("#delete-item").find("form").attr("action");
    $.ajax({
        dataType: 'json',
        type:'delete',
        url: form_action,
    }).done(function(data){
        $(".modal").modal('hide');
        // c_obj.remove();
        toastr.success('Estante Eliminado corectamente.', 'Success Alert', {timeOut: 5000});
        getPageDataEst();
    });
});
/* Edit Post */
$("body").on("click",".edit-item",function(){
    var id = $(this).parent("td").data('id');
    var nombre = $(this).parent("td").prev("td").prev("td").text();
    var ubicacion = $(this).parent("td").prev("td").text();

    $( "#edit-item").find("input[name='nombre']").val(nombre);
    $("#edit-item").find("input[name='ubicacion']").val(ubicacion);
    $("#edit-item").find("form").attr("action",est + '/' + id);
});
/* Updated new Estante */
$(".crud-submit-edit").click(function(e){
    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var nombre = $("#edit-item").find("input[name='nombre']").val();;
    var ubicacion = $("#edit-item").find("input[name='ubicacion']").val();

    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: form_action,
        data:{nombre:nombre,ubicacion:ubicacion}
    }).done(function(data){
        getPageDataEst();
        $(".modal").modal('hide');
        $("#create-estante").find("input[name='nombre']").val(" ");
        $("#create-estante").find("input[name='ubicacion']").val(" ");
        toastr.success('Estante Actualizado Correctamente.', 'Success Alert', {timeOut: 5000});
    });
});