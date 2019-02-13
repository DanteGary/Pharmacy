@extends('layouts.admin')
@section('contenidoprod')
<style type="text/css">
    button{
        margin-top: 1.3em;
    }
</style>
    
    <h1>Generar Reporte Compra</h1>
    <div class="cabezeraCompra">
    @if(isset($fechaD))
      <h3>De: {{$fechaD}} Hasta: {{$fechaH}}</h3>
      @endif
    </div>
        <div class="row">
                {{-- {{ route('producto.reporte') }} --}}
           <form action="{{url('/reporteCompra') }}" method="POST">
                {{ csrf_field() }}   

                <div class="col-md-3">
           Desde: <input type="date" name="fechaD" class="form-control" data-error="Ingrese fecha inicial" required />
            <div class="help-block with-errors"></div>
        </div>
      <div class="col-md-3">
           Hasta: <input type="date" name="fechaH" class="form-control" data-error="Ingrese fecha final" required />
            <div class="help-block with-errors"></div>
        </div>
          <div class="col-md-3">
          <button type="submit" class="btn btn-info   fa fa-search " id="generar-reporte">Buscar</button>
          </div>
           </form>
           </div>
           @if(isset($reporte))
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Producto</th>
                          <th>Marca</th>
                          <th>Cantidad</th>
                          <th>precio Unitario</th>
                          <th>precio Compra</th>
                          <th>Proveedor</th>
                        </thead>
                        <tbody id="reporteCompra" class="buscar">
                            <?php 
                              $totalUnitario=0;
                              $totalCompra=0;
                              $ganancia=0;

                            ?>
                            @foreach($reporte as $repor)
                            <?php $totalUnitario=sprintf("%.2f",$totalUnitario+$repor->preciounitario);
                                  $totalCompra=sprintf("%.2f",$totalCompra+$repor->preciocompra);
                                  $ganancia=sprintf("%.2f",$totalUnitario-$totalCompra); 
                                  
                                  ?>
                            <tr>
                            <td>{{$repor->nombre}}</td>
                            <td>{{$repor->marca}}</td>
                            <td>{{$repor->stockTotal}}</td>
                            <td>{{$repor->preciounitario}}</td>
                            <td>{{$repor->preciocompra}}</td>
                            <td>{{$repor->NombreProveedor}}</td>
                                
                            </tr>
                            @endforeach
                            <tr style="background: #00c0ef;">
                              <td>Totales</td>
                              <td></td>
                              <td></td>
                              <td>{{$totalUnitario}}</td>
                              <td>{{$totalCompra}}</td>
                              <td>{{$ganancia}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="display: none;">
                <div class="col-xs-12">
                    <input type="button" class="btn btn-success" value="Imprimir" onclick="window.print();">
                </div>
            </div>
           @endif

        
    
@endsection