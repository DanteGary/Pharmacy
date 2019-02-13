manageDataCli();
/* Get Page Data*/
function manageDataCli() {
    $.ajax({
        dataType: 'json',
        url: cli,
        data: {page:page}
    }).done(function(data){
        manageRowCli(data.data);
    });
}
function algo(){
    alert("r");
    $("#Select").load(" #Select");
}
function getPageDataCli() {
	$.ajax({
    	dataType: 'json',
    	url: 'getclientes',
    	data: {page:page}
	}).done(function(data){
        
		manageRowCli(data.data);
	});
}
/* Add new Client table row */
function manageRowCli(data) {
	$.each( data, function( key, value ) {
	  	 $("#Select").append('<option value='+value.id+'>Nombre: '+value.nombre+' Nit: '+value.nit+'</option>');
	});
}
/* Create new Client */
$(".cliente-submit").click(function(e){
    e.preventDefault();
    var form_action = $("#create-cliente").find("form").attr("action");
    var nombre = $("#create-cliente").find("input[name='nombre']").val();
    var apellidos = $("#create-cliente").find("input[name='apellidos']").val();
    var nit = $("#create-cliente").find("input[name='nit']").val();
    var estado=0;
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{nombre:nombre,apellidos:apellidos, nit:nit,estado:estado}
    }).done(function(data){
        manageDataCli();
        $(".modal-cli").modal('hide');
        $("#create-cliente").find("input[name='nombre']").val(" ");
        $("#create-cliente").find("input[name='nit']").val(" ");
        $("#create-cliente").find("input[name='apellidos']").val(" ");
        toastr.success('Cliente Creado satisfactoriamente.', 'Success Alert', {timeOut: 5000});
        location.reload();
    });
});

