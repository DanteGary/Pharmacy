var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
manageDataProd();
manageDataProdS();
/* manage data list */
function manageDataProd() {
    $.ajax({
        dataType: 'json',
        url: prod,
        data: { page: page }
    }).done(function(data) {
        manageRowProd(data.data);
    });
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/* Get Page Data*/
function getPageDataProd() {
    $.ajax({
        dataType: 'json',
        url: prod,
        data: { page: page }
    }).done(function(data) {
        manageRowProd(data.data);

    });
}

function manageDataProdS() {
    $.ajax({
        dataType: 'json',
        url: prodS,
        data: { page: page }
    }).done(function(data) {
        manageRowProdStock(data.data);
    });
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/* Get Page Data*/
function getPageDataProdS() {
    $.ajax({
        dataType: 'json',
        url: prodS,
        data: { page: page }
    }).done(function(data) {

        manageRowProdStock(data.data);
    });
}
/* Add new Proveedor table row */
function manageRowProd(data) {
    var contadorV = 0;
    var contadorVen = 0;
    var rows = '';
    var fecha = new Date();
    $.each(data, function(key, value) {
        var fechas = new Date(value.fechavence);
        var fechaFinal = fechas - fecha;
        //console.log(fechaFinal/(1000*60*60*24*30) );
        var mes = (Math.round((fechaFinal / (1000 * 60 * 60 * 24 * 30))));
        if (mes < 6 && mes > 0) {
            rows = rows + '<tr style="background:#dc6464; ">';
            contadorV++;
            $('#alertVence').text(contadorV);
            jQuery(".mvence").append('<li class="header" style="background:#bfc1c0;"><a href="' + pvencidos + '"> >> ' + value.nombre + ' Proximo a vencer <p> en ubicacion: [' + value.nombreestante + ' -> ' + value.ubicacion + ']</p></a></li>');
        } else if (mes >= 6 && mes < 12) {
            rows = rows + '<tr style="background:yellow; " >';
        } else if (mes > 12) {
            rows = rows + '<tr style="background:#00a65a; " >';
        } else if (mes <= 0) {
            rows = rows + '<tr style="background:#282828; color:white;" >';
            contadorVen++;
            $('#alertVencido').text(contadorVen);
            jQuery(".mvencido").append('<li class="header" style="background:#bfc1c0;"><a href="' + pvencidos + '"> >> ' + value.nombre + ' esta vencido <p> en hubicacion: [' + value.nombreestante + ' -> ' + value.ubicacion + ']</p></a></li>');
        } else rows = rows + '<tr style="background:#00a65a; " >'

        rows = rows + '<td>' + value.nombre + '</td>';
        rows = rows + '<td>' + value.marca + '</td>';
        rows = rows + '<td>' + value.cantidad + '</td>';
        rows = rows + '<td>' + value.descripcion + '</td>';
        rows = rows + '<td>' + value.preciounitario + '</td>';
        rows = rows + '<td>' + value.preciocompra + '</td>';
        rows = rows + '<td style=font-size:1em;>' + value.fechavence + '</td>';
        rows = rows + '<td>' + value.nombrecategories + '</td>';
        rows = rows + '<td >' + value.nombreestante + '</td>';
        rows = rows + '<td>' + value.ubicacion + '</td>';
        rows = rows + '<td>' + value.nombreproveedor + '</td>';
        rows = rows + '<td style="display:none" >' + value.id_cat + '</td>';
        rows = rows + '<td style="display:none">' + value.id_estante + '</td>';
        rows = rows + '<td style="display:none" >' + value.id_proveedor + '</td>';
        if (mes < 6 && mes > 0) {
            rows = rows + '<td>CASI VENCIDO</td>';
            }else if(mes>=6 && mes<12){
                rows = rows + '<td>ALERTA</td>';
            }else if(mes>12){
                rows = rows + '<td>VIGENTE</td>';
            }else if(mes<=0){
                rows = rows + '<td>VENCIDO</td>';
            }else rows = rows +'<td>VIGENTE</td>';
	  	rows = rows + '<td style="background:white;" data-id="'+value.id+'">'; 
        rows = rows + '<button data-toggle="modal" data-target="#edit-producto" class="btn btn-success edit-producto fa fa-edit"></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#renovar-producto" class="btn btn-warning edit-producto fa fa-shopping-cart "></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#delete-producto" class="btn btn-danger remove-producto fa fa-trash "></button> ';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("#productos").html(rows);
}
function manageRowProdStock(data) {
    var contadorVen = 0;
    var contadorsk = 0;
    var rows = '';
    var ff = 5;
    $.each(data, function(key, value) {

        if (value.cantidad < 10 && value.cantidad > 0) {
            rows = rows + '<tr style="background:#dc6464">';
            contadorsk++;
            $('#alertStock').text(contadorsk);
            jQuery(".mstock").append('<li class="header" style="background:#bfc1c0;"><a href="' + pagotados + '"> >> ' + value.nombre + ' quedan: [ ' + value.cantidad + ' ]<p> en estante: ' + value.nombreestante + ' -> ' + value.ubicacion + '</p></a></li>');
        } else if (value.cantidad >= 10 && value.cantidad < 20) {
            rows = rows + '<tr style="background:yellow" >';
        } else if (value.cantidad > 20) {
            rows = rows + '<tr style="background:#00a65a" >';
        } else if (value.cantidad <= 0) {
            rows = rows + '<tr style="background:#282828; color:white;" >';
            contadorVen++;
            $('#alertAgotados').text(contadorVen);
            jQuery(".magotado").append('<li class="header" style="background:#bfc1c0;"><a href="' + pagotados + '">  >> ' + value.nombre + ' Agotado <p> en hubicacion: [' + value.nombreestante + ' -> ' + value.ubicacion + ']</p></a></li>');
        } else {
            rows = rows + '<tr style="background:#00a65a" >';
        }


        rows = rows + '<td>' + value.nombre + '</td>';
        rows = rows + '<td>' + value.marca + '</td>';
        rows = rows + '<td>' + value.cantidad + '</td>';
        rows = rows + '<td>' + value.descripcion + '</td>';
        rows = rows + '<td>' + value.preciounitario + '</td>';
        rows = rows + '<td>' + value.preciocompra + '</td>';
        rows = rows + '<td>' + value.fechavence + '</td>';

        rows = rows + '<td>' + value.nombrecategories + '</td>';
        rows = rows + '<td>' + value.nombreestante + '</td>';
        rows = rows + '<td>' + value.ubicacion + '</td>';
        rows = rows + '<td>' + value.nombreproveedor + '</td>';
        rows = rows + '<td style="display:none" >' + value.id_cat + '</td>';
        rows = rows + '<td style="display:none">' + value.id_estante + '</td>';
        rows = rows + '<td style="display:none" >' + value.id_proveedor + '</td>';

        if (value.cantidad > 0 && value.cantidad < 10) {
            rows = rows + '<td>Producto con poco stock</td>';
        } else if (value.cantidad >= 10 && value.cantidad < 20) {
            rows = rows + '<td>Producto buen estock</td>';
        } else if (value.cantidad > 20) {
            rows = rows + '<td>Producto con gran stock</td>';
        } else if (value.cantidad <= 0) {
            rows = rows + '<td>Producto agotados..!</td>';
        } else rows = rows + '<td>Producto con gran stock</td>';

        rows = rows + '<td style="background:white;" data-id="' + value.id + '">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-producto" class="btn btn-success edit-producto fa fa-edit"></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#renovar-producto" class="btn btn-warning edit-producto fa fa-shopping-cart "></button> ';
        rows = rows + '<button data-toggle="modal" data-target="#delete-producto" class="btn btn-danger remove-producto fa fa-trash "></button> ';
        rows = rows + '</td>';
        rows = rows + '</tr>';
    });
    $("#productosStock").html(rows);
    //alert(contador);
}
/* Create new Producto */
$(".producto-submit").click(function(e) {
    e.preventDefault();
    var form_product = $("#create-producto").find("form").attr("action");
    var nombre = $("#create-producto").find("input[name='nombre']").val();
    var marca = $("#create-producto").find("input[name='marca']").val();
    var cantidad = $("#create-producto").find("input[name='cantidad']").val();
    // var capacidad = $("#create-producto").find("input[name='capacidad']").val();
    var descripcion = $("#create-producto").find("input[name='descripcion']").val();
    var preciounitario = $("#create-producto").find("input[name='preciounitario']").val();
    var preciocompra = $("#create-producto").find("input[name='preciocompra']").val();
    var fechavence = $("#create-producto").find("input[name='fechavence']").val();
    var id_cat = $("#create-producto").find("select[name='id_cat']").val();
    var id_estante = $("#create-producto").find("select[name='id_estante']").val();
    var id_proveedor = $("#create-producto").find("select[name='id_proveedor']").val();
    // var id_cap = $("#create-producto").find("select[name='id_cap']").val();
    var fecha = new Date();
    var dd = fecha.getDate();
    var mm = fecha.getMonth() + 1; //fecha es 0!
    var yyyy = fecha.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    fecha = yyyy + '-' + mm + '-' + dd;
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: form_product,
        data: { nombre: nombre, marca: marca, cantidad: cantidad, descripcion: descripcion, preciounitario: preciounitario, preciocompra: preciocompra, fechavence: fechavence, id_cat: id_cat, id_estante: id_estante, id_proveedor: id_proveedor, fechaReg: fecha, estado: 0, stockTotal: cantidad }
        // ,id_cap:id_cap,capacidad:capacidad
    }).done(function(data) {
        getPageDataProd();
        $(".modal").modal('hide');
        toastr.success('Producto Creado satisfactoriamente.', 'Success Alert', { timeOut: 5000 });
        location.reload();
        $("#create-producto").find("input[name='nombre']").val(" ");
        $("#create-producto").find("input[name='marca']").val(" ");
        $("#create-producto").find("input[name='cantidad']").val(" ");
        $("#create-producto").find("input[name='descripcion']").val(" ");
        $("#create-producto").find("input[name='preciounitario']").val(" ");
        $("#create-producto").find("input[name='preciocompra']").val(" ");
        $("#create-producto").find("input[name='fechavence']").val(" ");
        $("#create-producto").find("select[name='id_cat']").val("");
        $("#create-producto").find("select[name='id_estante']").val("");
        $("#create-producto").find("select[name='id_proveedor']").val("");
    });
});


$(".renovar-submit").click(function(e) {
    e.preventDefault();
    var cant=0;
    var hri=$("#hri").val();
    cant=parseInt($("#cant").val());
    var form_product = $("#renovar-producto").find("form").attr("action");
    var nombre = $("#renovar-producto").find("input[name='nombre']").val();
    var marca = $("#renovar-producto").find("input[name='marca']").val();
    var cantidad = parseInt($("#renovar-producto").find("input[name='cantidad']").val());
    // var capacidad = $("#renovar-producto").find("input[name='capacidad']").val();
    var descripcion = $("#renovar-producto").find("input[name='descripcion']").val();
    var preciounitario = $("#renovar-producto").find("input[name='preciounitario']").val();
    var preciocompra = $("#renovar-producto").find("input[name='preciocompra']").val();
    var fechavence = $("#renovar-producto").find("input[name='fechavence']").val();
    var id_cat = $("#renovar-producto").find("select[name='id_cat']").val();
    var id_estante = $("#renovar-producto").find("select[name='id_estante']").val();
    var id_proveedor = $("#renovar-producto").find("select[name='id_proveedor']").val();
    // var id_cap = $("#renovar-producto").find("select[name='id_cap']").val();
    var total=cantidad+cant
    var fecha = new Date();
    var dd = fecha.getDate();
    var mm = fecha.getMonth() + 1; //fecha es 0!
    var yyyy = fecha.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    fecha = yyyy + '-' + mm + '-' + dd;
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: form_product,
        data: { nombre: nombre, marca: marca, cantidad: cantidad, descripcion: descripcion, preciounitario: preciounitario, preciocompra: preciocompra, fechavence: fechavence, id_cat: id_cat, id_estante: id_estante, id_proveedor: id_proveedor, fechaReg: fecha, estado: 0, stockTotal: cantidad }
        // ,id_cap:id_cap,capacidad:capacidad
    }).done(function(data) {
        
            manageDataProdS();
            manageDataProd();
            
        $(".modal").modal('hide');
        toastr.success('Producto Creado satisfactoriamente.', 'Success Alert', { timeOut: 5000 });
        //location.reload();
        $("#renovar-producto").find("input[name='nombre']").val(" ");
        $("#renovar-producto").find("input[name='marca']").val(" ");
        $("#renovar-producto").find("input[name='cantidad']").val(" ");
        $("#renovar-producto").find("input[name='descripcion']").val(" ");
        $("#renovar-producto").find("input[name='preciounitario']").val(" ");
        $("#renovar-producto").find("input[name='preciocompra']").val(" ");
        $("#renovar-producto").find("input[name='fechavence']").val(" ");
        $("#renovar-producto").find("select[name='id_cat']").val("");
        $("#renovar-producto").find("select[name='id_estante']").val("");
        $("#renovar-producto").find("select[name='id_proveedor']").val("");
    }).fail(function() {
                toastr.error('Error revice los datos ingresados.', 'Success Alert', {timeOut: 5000});
            });
});
/* Remove Producto */
$("body").on("click", ".remove-producto", function() {
    var nombre = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var id = $(this).parent("td").data('id');
    $("#delete-producto").find("form").attr("action", prod + '/' + id);
    $("#delete-producto").find("input[name='nombre']").val(nombre);

});

$('.crud-submit-delete').click(function(e) {
    e.preventDefault();
    // var c_obj = $(this).parents("tr");
    var form_product = $("#delete-producto").find("form").attr("action");
    $.ajax({
        dataType: 'json',
        type: 'DELETE',
        url: form_product,
    }).done(function(data) {
        $(".modal").modal('hide');
        // c_obj.remove();
        toastr.success('Producto Eliminado correctamente.', 'Success Alert', { timeOut: 5000 });
        getPageDataProdS();
        //location.reload();
    });
});


/* Edit Post */
$("body").on("click", ".edit-producto", function() {
    var id = $(this).parent("td").data('id');
    var cat_id = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
    var est_id = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var prov_id = $(this).parent("td").prev("td").prev("td").text();
    var nombre = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var marca = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var cantidad = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var descripcion = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var preciounitario = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var preciocompra = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var fechavence = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var ncat = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var nprov = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var nestante = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var ubicacion = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();


    $("#edit-producto").find("input[name='nombre']").val(nombre);
    $("#edit-producto").find("input[name='marca']").val(marca);
    $("#edit-producto").find("input[name='cantidad']").val(cantidad);
    $("#edit-producto").find("input[name='descripcion']").val(descripcion);
    $("#edit-producto").find("input[name='preciounitario']").val(preciounitario);
    $("#edit-producto").find("input[name='preciocompra']").val(preciocompra);
    $("#edit-producto").find("input[name='fechavence']").val(fechavence);
    $("#edit-producto").find("select[name='id_cat']").append('<option value="' + cat_id + '" selected="selected">' + ncat + '</option>');
    $("#edit-producto").find("select[name='id_estante']").append('<option value="' + est_id + '" selected="selected">Estante: ' + ubicacion + ' -> ' + nestante + '</option>');
    $("#edit-producto").find("select[name='id_proveedor']").append('<option value="' + prov_id + '" selected="selected">' + nprov + '</option>');
    $("#edit-producto").find("form").attr("action", prod + '/' + id);
    $("#edit-producto").find("select[name='id_cat']").attr("value", cat_id);
    $("#edit-producto").find("select[name='id_estante']").attr("value", est_id);
    $("#edit-producto").find("select[name='id_proveedor']").attr("value", prov_id);


    $("#renovar-producto").find("input[name='hri']").val(id);
    $("#renovar-producto").find("input[name='cant']").val(cantidad);
    $("#renovar-producto").find("input[name='nombre']").val(nombre);
    $("#renovar-producto").find("input[name='marca']").val(marca);
    $("#renovar-producto").find("input[name='cantidad']").val(cantidad);
    $("#renovar-producto").find("input[name='descripcion']").val(descripcion);
    $("#renovar-producto").find("input[name='preciounitario']").val(preciounitario);
    $("#renovar-producto").find("input[name='preciocompra']").val(preciocompra);
    $("#renovar-producto").find("input[name='fechavence']").val(fechavence);
    $("#renovar-producto").find("select[name='id_cat']").append('<option value="' + cat_id + '" selected="selected">' + ncat + '</option>');
    $("#renovar-producto").find("select[name='id_estante']").append('<option value="' + est_id + '" selected="selected">Estante: ' + ubicacion + ' -> ' + nestante + '</option>');
    $("#renovar-producto").find("select[name='id_proveedor']").append('<option value="' + prov_id + '" selected="selected">' + nprov + '</option>');
    $("#renovar-producto").find("select[name='id_cat']").attr("value", cat_id);
    $("#renovar-producto").find("select[name='id_estante']").attr("value", est_id);
    $("#renovar-producto").find("select[name='id_proveedor']").attr("value", prov_id);
});
/* Updated new Proveedor */
$(".crud-producto-edit").click(function(e) {
    e.preventDefault();
    var urleditprod = $("#edit-producto").find("form").attr("action");
    var nombre = $("#edit-producto").find("input[name='nombre']").val();
    var marca = $("#edit-producto").find("input[name='marca']").val();
    var cantidad = $("#edit-producto").find("input[name='cantidad']").val();
    // var capacidad = $("#edit-producto").find("input[name='capacidad']").val();
    var descripcion = $("#edit-producto").find("input[name='descripcion']").val();
    var preciounitario = $("#edit-producto").find("input[name='preciounitario']").val();
    var preciocompra = $("#edit-producto").find("input[name='preciocompra']").val();
    var fechavence = $("#edit-producto").find("input[name='fechavence']").val();
    var id_cat = $("#edit-producto").find("select[name='id_cat']").val();
    var id_estante = $("#edit-producto").find("select[name='id_estante']").val();
    var id_proveedor = $("#edit-producto").find("select[name='id_proveedor']").val();
    // var id_cap = $("#edit-producto").find("select[name='id_cap']").val();

    $.ajax({
        dataType: 'json',
        type: 'PUT',
        url: urleditprod,
        data: { nombre: nombre, marca: marca, cantidad: cantidad, descripcion: descripcion, preciounitario: preciounitario, preciocompra: preciocompra, fechavence: fechavence, id_cat: id_cat, id_estante: id_estante, id_proveedor: id_proveedor }
        // ,id_cap:id_cap,capacidad:capacidad
    }).done(function(data) {
        getPageDataProdS();
        $(".modal").modal('hide');
        $("#create-producto").find("input[name='nombre']").val(" ");
        $("#create-producto").find("input[name='marca']").val(" ");
        $("#create-producto").find("input[name='cantidad']").val(" ");
        $("#create-producto").find("input[name='descripcion']").val(" ");
        $("#create-producto").find("input[name='preciounitario']").val(" ");
        $("#create-producto").find("input[name='preciocompra']").val(" ");
        $("#create-producto").find("input[name='fechavence']").val(" ");
        $("#create-producto").find("select[name='id_cat']").val("seleccine");
        $("#create-producto").find("select[name='id_estante']").val("seleccione");
        $("#create-producto").find("select[name='id_proveedor']").val("seleccione ");
        toastr.success('Producto Actualizado Correctamente.', 'Success Alert', { timeOut: 5000 });
        location.reload();

    });
});
