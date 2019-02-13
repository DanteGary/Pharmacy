var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
manageDataVenta();
verificarcampos();
getPageSelectProd();
//manageDataCli();

//quitar el botton de editar cuando stock este en 0
//cargar el combo de productos con ajax//
//botton de recargar//
//backups a la base de datos automaticos
//limpiar los campos despues de vender//

/* manage data list */
function manageDataVenta() {    
    $.ajax({
        dataType: 'json',
        url: venta,
        data: {page:page}
    }).done(function(data){

    	
    	manageRowVenta(data.data);
        
    });
}
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
/* Get Page Data*/
function getPageDataVenta() {
	$.ajax({
    	dataType: 'json',
    	url: venta,
    	data: {page:page}
	}).done(function(data){
		manageRowVenta(data.data);
	});
}
/* Add new venta table row */
function manageRowVenta(data) {
    var totvendia=0;
    var totventunit=0;
    var cont=0;
	var	rows = '';
    var optionr='';
    $.each( data, function( key, value ) {
        totventunit=value.preciounitario*value.cantidadVenta;
        totvendia=totvendia+totventunit;
        cont=cont+1;
        var fecha = new Date(value.fecha);
        var options = { year: 'numeric', month: 'long', day: 'numeric' };
        fecha1=fecha.toLocaleDateString("es-ES", options)
        rows = rows + '<tr>';
        rows = rows + '<td>'+cont+'</td>';
        //rows = rows + '<td>'+fecha1+'</td>';
        rows = rows + '<td>'+value.nombrePro+'</td>';
        rows = rows + '<td>'+value.cantidadVenta+' Uds.</td>';
        rows = rows + '<td>'+ totventunit+' Bs.-</td>';
        rows = rows + '<td style="display:none;" data-id="'+value.idDetalleVenta+'"></td>';
        rows = rows + '</tr>';

    });
    rows = rows+'<tr>';
    rows = rows+'<td>Total del dia</td>';
    rows = rows+'<td></td>';
    rows = rows+'<td></td>';
    rows = rows+'<td>'+ totvendia+' Bs.-</td>';
    rows = rows+'</tr>';
    $("#ventas").html(rows);
}
// para actualizar select de ventas
function getPageSelectProd() {
    $.ajax({
        dataType: 'json',
        url: prodRV,
        data: {page:page}
    }).done(function(data){
        //manageSelectProd(data.data);
        $('#prostock').append('<select><strong>texto de prueba</strong></select>');
    });
}
function manageSelectProd(data){
    var optionr='';
    $.each(data,function(key,value){
        optionr=optionr+'<option>'+value.nombre+' Stock: '+value.cantidad+'</option>';
    });
    $("#prostock").html('<option>select</option>');
}
/* Remove venta */
$("body").on("click",".remove-item",function(){
    var nombre = $(this).parent("td").prev("td").text();
    var id = $(this).parent("td").data('id');
    $("#delete-item").find("form").attr("action",venta + '/' + id);
    $("#delete-item").find("input[name='nombre']").val(nombre);
    
});
$('.categoria-submit-delete').click(function(e){
    e.preventDefault();
    var form_action = $("#delete-item").find("form").attr("action");
    $.ajax({
        dataType: 'json',
        type:'delete',
        url: form_action,
    }).done(function(data){
        $(".modal").modal('hide');
        toastr.success('Categoria Eliminada corectamente.', 'Success Alert', {timeOut: 5000});
        getPageDataVenta();
    });
});
var productos=[];
var contadorList=0;
function nuevo(variable) {
    var id_prod = $("#create-venta").find("select[name='id_pro']").val();
    var cantidad = $("#create-venta").find("input[name='cantidad']").val();
    cantidad=parseInt(cantidad);
    var prod={
        id:'',
        nombre:'',
        precio:'',
        cantidad:''  
    };
    $.each( variable, function( key, value ) {
        if (value.id==id_prod) {
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var output = d.getFullYear()+'-'+month+'-'+day;
            if (cantidad<=value.cantidad) {
                prod={                
                identificador:contadorList,
                id:value.id,
                nombre:value.nombre,
                precio:value.preciounitario,
                cantidadPro:value.cantidad,
                cantidad:cantidad,
                fecha:output   
            };
            contadorList++;
            productos.push(prod);
                toastr.success('Agregado para la venta.', 'Success Alert', {timeOut: 5000});

            }else{
                toastr.error('No existe esa cantidad.', 'Success Alert', {timeOut: 5000});
            }   
        }else{
                //toastr.error('Seleccione producto.', 'Success Alert', {timeOut: 5000});
        }       
    });
    mostrarTabla(productos);   
}
//muestra la sub tabla del arreglo de elementos antes de isertarse
function mostrarTabla(arreglo){
    var total=0;
    var contador=0;
    var rows = '';
        $.each( arreglo, function( key, value ) { 
        var cant=arreglo[contador]['cantidad'];
        var cantPro=arreglo[contador]['cantidadPro'];
        rows = rows + '<tr>';
        rows = rows + '<td>'+arreglo[contador]["cantidad"]+'</td>';
        rows = rows + '<td>'+arreglo[contador]["nombre"]+'</td>';        
        rows = rows + '<td>'+arreglo[contador]["precio"]+' Bs.-</td>';
        rows = rows + '<td>'+arreglo[contador]["cantidad"]*arreglo[contador]["precio"]+' Bs.-</td>';   
        rows = rows + '<td><a href="#" class="btn btn-danger" onclick="nuevo2('+arreglo[contador]["identificador"]+')"><i class="fa fa-trash"></i></a></td>';     
        rows = rows + '</tr>';
        total=total+arreglo[contador]["cantidad"]*arreglo[contador]["precio"];
        contador++;
    });
        rows = rows + '<tr style="background:rgba(8, 123, 143, 0.84);font-size:20px;">';
        rows = rows + '<td></td>';
        rows = rows + '<td>Total</td>';
        rows = rows + '<td></td>';
        rows = rows + '<td style="font-size:30px;" >'+total+' Bs.- </td>';
        rows = rows + '</tr>';
        $("#carrito").html(rows);
        $("#total").val(total);
        
}
$( "#efectivo" ).change(function() {
    var cambio;
    var total=parseFloat($("#total").val());
  var efect=parseFloat($("#efectivo").val());
  if(efect<total){
    toastr.error('El efectivo es menor al total a pagar.', 'Success Alert', {timeOut: 5000});
    $(".venta-submit").attr("disabled", true);
    $("#cambio").val('0');

  }else if(total>0){
    $(".venta-submit").attr("disabled", false);
    cambio=efect-total;
    $("#cambio").val(cambio);
  }else{
    toastr.error('Seleccione al menos un producto.', 'Success Alert', {timeOut: 5000});
    $(".venta-submit").attr("disabled", true);
    $("#cambio").val('0');

  }
});

function verificarcampos()
{
    var efectivo = $("#efectivo").val();
        if(efectivo<=0){
            $(".venta-submit").attr("disabled", true);
        }
}
/* Create new Venta y actualiza el stock*/
 $(".venta-submit").click(function(e){
    verificarcampos();
    var form_action = $("#create-venta").find("form").attr("action");
    var id_client = $("#create-venta").find("select[name='id_client']").val();
    e.preventDefault();
    var contador=0;
    $.each( productos, function( key, value ) {
        var productoid= productos[contador]["id"];
        var fecha =productos[contador]["fecha"];        
        var cantidad=productos[contador]["cantidad"];
        var cantotal=productos[contador]["cantidadPro"];
        var totalaupdate=cantotal-cantidad;
        $.ajax({
            dataType:'json',
                type:'POST',
                url: 'venta',
                data:{id_producto:productoid,fecha:fecha,cantidad:cantidad,estado:0,id_client:id_client}
        }).done(function(data){
            $.ajax({
                dataType: 'json',
                type:'PUT',
                url: 'productos/'+productoid,
                data:{cantidad:totalaupdate}
            }).done(function(data){
                //$(".modal").modal('hide');
            }).fail(function() {
                toastr.error('Error revice los datos ingresados.', 'Success Alert', {timeOut: 5000});
            });
            getPageDataVenta();
        });
        contador++;
    });
    toastr.success('Venta Registrada.', 'Success Alert', {timeOut: 5000});
    ///verificarcampos();
    location.reload();
});
//funcion que elimina un elemento del arreglo ficticio
function nuevo2(a){    
    var c=0;
    while(productos.length>c)
    {
        if (productos[c]["identificador"]==a) {
            productos.splice(c,1);
        }
        c++;
    }
    mostrarTabla(productos);

}
$.ajax({
  statusCode: {
    404: function() {
      alert( "page not found" );
    }
  }
});
