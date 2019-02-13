@extends('layouts.admin')
@section('reportesVentas')
<style media="print" type="text/css">
    
  </style>
  <style type="text/css">
  	button{
  		margin-top: 1.3em;
  	}
  	.btn-imprimir{
  	text-align: right !important; 
    display: block;
  	}
  	.totalRep{
  		background-color: #3c8dbc;font-size: 21px;
  	}
  	form{
  		padding: 24px;
  	}
  </style>
  <div class="cabezera">
    <?php
    if(isset($fecha1)&& isset($fecha2)){
     date_default_timezone_set('America/La_Paz');
    
    $fechaR1=date('d-F-Y',strtotime($fecha1));
    $fechaR2=date('d-F-Y',strtotime($fecha2));
    echo "Reporte de: ".$fechaR1." a ".$fechaR2;
    echo "<br>";
    foreach ($usersystem as $key => $value) {
     	if ($value->id==$userss) {
     		echo "De Usuario: ".$value->name;
     	}

     } 
    //echo strtotime($fecha1);
  }
    ?>
   
  </div>
  <div>
  	<div class="btn-imprimir" >
  				<label>Imprimir</label>
    			<button class="btn btn-warning fa fa-print" onclick="window.print();"></button>
       </div>
  </div>
    <div class="row">
    <form data-toggle="validator" action="{{url('reporteVenta')}}" method="GET">
      <div class="col-md-3">
           De: <input type="date" name="fecha1" class="form-control" data-error="Ingrese fecha inicial" required />
            <div class="help-block with-errors"></div>
        </div>
      <div class="col-md-3">
           Hasta: <input type="date" name="fecha2" class="form-control" data-error="Ingrese fecha final" required />
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                Usuario <select class="form-control  "  name="usersys" data-error="selccione Usuario" required>
                 <option value="">Seleccione</option>
                    @foreach($usersystem as $us)
          <option value="{{$us->id}}" required>{{$us->name}}</option>
        @endforeach
                 </select>
              <div class="help-block with-errors"></div>
          </div>
        </div>
          <div class="col-md-3">
          <button type="submit" class="btn btn-info   fa fa-search " id="generar-reporte">Buscar</button>
          </div>
          
        </div>
      </div>
    </form>
    @if(isset($repVentas))

    <div class="row table-reporte">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="table-primary">
                      <th>Producto</th>
                      <th>fecha venta</th>
                      <th>Cantidad Vendida</th>
                      <th>Sub Total</th>
                    </thead>
                    <tbody id="ventasReportes" class="buscar">
                    <?php $total=0;?>
                      @foreach($repVentas as $rep)
                      <?php
                       $subtotal=$rep->cantidad*$rep->preciounitario;
                       $total=$total+$subtotal;
                        ?>
                      	<tr>
                      		<td>{{$rep->nombre}}</td>
                      		<td>{{$rep->fecha}} </td>
                      		<td>{{$rep->cantidad}} Uds</td>
                      		<td>{{$subtotal}} :Bs.-</td>
                      	</tr>
                      @endforeach
                      <tr class="totalRep" >
                      	<td>Total</td>
                      	<td></td>
                      	<td></td>
                      	<td>{{$total}} :Bs.-</td>
                      </tr>
                    </tbody>
                </table>
                <ul id="pagination" class="pagination-sm"></ul>
                
              	
              </div>
            </div>
    </div>
@endif
@endsection