var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
manageDataUsuario();

/* manage data list */
function manageDataUsuario() {
    $.ajax({
        dataType: 'json',
        url: usuario,
        data: { page: page }
    }).done(function(data) {
        manageRowUsuario(data.data);
    });
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/* Get Page Data*/
function getPageDataUsuario() {
    $.ajax({
        dataType: 'json',
        url: usuario,
        data: { page: page }
    }).done(function(data) {

        manageRowUsuario(data.data);
    });
}
/* Add new Proveedor table row */
function manageRowUsuario(data) {
    var rows = '';
    $.each(data, function(key, value) {
        rows = rows + '<tr>';
        rows = rows + '<td>' + value.name + '</td>';
        rows = rows + '<td>' + value.email + '</td>';
        rows = rows + '<td data-id="' + value.id + '">';
        rows = rows + '<button data-toggle="modal" data-target="#usuario-edit-item" class="btn btn-success edit-usuario-item fa fa-edit"></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#usuario-delete-item" class="btn btn-danger remove-usuario-item fa fa-trash "></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#usuario-editPass-item" class="btn btn-warning editPass-usuario-item fa fa-key "></button> ';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("#usuario").html(rows);
}
/* Create new Usuario */
$(".usuario-submit").click(function(e) {
    e.preventDefault();
    var form_action = $("#create-usuario").find("form").attr("action");
    var nombre = $("#create-usuario").find("input[name='nombre']").val();
    var email = $("#create-usuario").find("input[name='email']").val();
    var pass = $("#create-usuario").find("input[name='pass']").val();
    var estado = 0;
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: form_action,
        data: { nombre: nombre, email: email, pass: pass, estado: estado }
    }).done(function(data) {
        getPageDataUsuario();
        $(".modal").modal('hide');
        $("#create-usuario").find("input[name='nombre']").val(" ");
        $("#create-usuario").find("input[name='email']").val(" ");
        $("#create-usuario").find("textarea[name='pass']").val(" ");
        $("#create-usuario").find("input[name='pass2']").val(" ");

        toastr.success('Usuario Creado satisfactoriamente.', 'Success Alert', { timeOut: 5000 });
    });
});
/* Remove Proveedor */
$("body").on("click", ".remove-usuario-item", function() {
    var nombre = $(this).parent("td").prev("td").prev("td").text();
    var id = $(this).parent("td").data('id');
    $("#usuario-delete-item").find("form").attr("action", usuario + '/' + id);
    $("#usuario-delete-item").find("input[name='nombre']").val(nombre);

});
$('.usuario-delete').click(function(e) {
    e.preventDefault();
    // var c_obj = $(this).parents("tr");
    var form_action = $("#usuario-delete-item").find("form").attr("action");
    $.ajax({
        dataType: 'json',
        type: 'delete',
        url: form_action,
    }).done(function(data) {
        $(".modal").modal('hide');
        // c_obj.remove();
        toastr.success('Usuario Eliminado corectamente.', 'Success Alert', { timeOut: 5000 });
        getPageDataUsuario();
    });
});
/* Edit Post */
$("body").on("click", ".edit-usuario-item", function() {
    var id = $(this).parent("td").data('id');
    var nombre = $(this).parent("td").prev("td").prev("td").text();
    var email = $(this).parent("td").prev("td").text();

    $("#usuario-edit-item").find("input[name='nombre']").val(nombre);
    $("#usuario-edit-item").find("input[name='email']").val(email);
    $("#usuario-edit-item").find("form").attr("action", usuario + '/' + id);
});
$("body").on("click", ".editPass-usuario-item", function() {
    var id = $(this).parent("td").data('id');
    $("#usuario-editPass-item").find("form").attr("action", usuario + '/' + id);

});
/* Updated new Proveedor */
$(".crud-submit-usuario-edit").click(function(e) {
    e.preventDefault();
    var form_action = $("#usuario-edit-item").find("form").attr("action");
    var name = $("#usuario-edit-item").find("input[name='nombre']").val();
    var email = $("#usuario-edit-item").find("input[name='email']").val();

    $.ajax({
        dataType: 'json',
        type: 'PUT',
        url: form_action,
        data: { name: name, email: email }
    }).done(function(data) {
        getPageDataUsuario();
        $(".modal").modal('hide');
        $("#usuario-edit-item").find("input[name='nombre']").val(" ");
        $("#usuario-edit-item").find("input[name='email']").val(" ");
        toastr.success('Usuario Actualizado Correctamente.', 'Success Alert', { timeOut: 5000 });
    });
});
$(".crud-submit-usuario-editPass").click(function(e) {
    e.preventDefault();

    var form_action = $("#usuario-editPass-item").find("form").attr("action");
    var password = $("#usuario-editPass-item").find("input[name='pass']").val();
    $.ajax({
        dataType: 'json',
        type: 'PUT',
        url: form_action,
        data: { password: password }
    }).done(function(data) {
        getPageDataUsuario();
        $(".modal").modal('hide');
        $("#usuario-editPass-item").find("input[name='pass']").val("");
        $("#usuario-editPass-item").find("input[name='pass2']").val("");
        toastr.success('Contrasenha  Actualizado Correctamente.', 'Success Alert', { timeOut: 5000 });
    });
});