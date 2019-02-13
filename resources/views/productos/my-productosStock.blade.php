@extends('layouts.admin')
@section('contenidoprod')

    <h1>Productos Stock</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-producto">Registrar nuevo <i class="fa fa-plus-square"></i></button>
    <div class="row">
      
            <div class="col-xs-12">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="table-primary">
                      <th scope="col">Nombre</th>
                      <th scope="col">Marca</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Precio U</th>
                      <th scope="col">Precio C</th>
                      <th scope="col">Fecha Vencimiento</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Estante</th>
                      <th scope="col">Ubicacion</th>
                      <th scope="col">Proveedor</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Opciones</th>
                    </thead>
                    <tbody id="productosStock" class="buscar">
                                    
                    </tbody>
                </table>
                <ul id="pagination" class="pagination-sm"></ul>
                
                @include('productos.create')
                @include('productos.edit')      
                @include('productos.delete')      
                @include('productos.renovar')      
              </div>
    </div>
</div>

@endsection

