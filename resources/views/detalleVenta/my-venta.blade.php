@extends('layouts.admin')
@section('contenidocat')

<div class="container">
    <h1>Vender <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#create-venta"><i style="font-size: 80px; color: black;" class="fa fa-cart-plus"></i></button></h1>
    <div class="row">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="table-primary">
                      <th>#</th>
                      <!-- <th>Fecha Venta</th> -->
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Total</th>
                    </thead>
                    <tbody id="ventas" class="buscar">
                      
                    </tbody>
                </table>
                <ul id="pagination" class="pagination-sm"></ul>
                
                @include('detalleVenta.create')
                @include('clientes.create')
              </div>
            </div>
    </div>
</div>
@endsection
