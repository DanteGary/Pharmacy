@extends('layouts.admin')
@section('contenidoprod')

    <h1>Productos por Vencimiento</h1>
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-producto">Registrar nuevo <i class="fa fa-plus-square"></i></button>
    <div class="row"> -->
      
            <div class="col-xs-12">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered table-condensed table-hover" data-show-header="true" data-pagination="true"
           data-id-field="name"
           data-page-list="[5, 10, 25, 50, 100, ALL]"
           data-page-size="5">
                    <thead class="table-primary">
                      <th data-field="nombre" data-formatter="nameFormatter">Nombre</th>
                      <th data-field="marca" data-formatter="nameFormatter"">Marca</th>
                      <th data-field="cantidad" data-formatter="nameFormatter">Cantidad</th>
                      <th data-field="descripcipcion" data-formatter="nameFormatter">Descripcion</th>
                      <th data-field="name" data-formatter="nameFormatter">Precio U</th>
                      <th data-field="name" data-formatter="nameFormatter">Precio C</th>
                      <th data-field="name" data-formatter="nameFormatter">Vencimiento</th>
                      <th data-field="name" data-formatter="nameFormatter">Categoria</th>
                      <th data-field="name" data-formatter="nameFormatter">Estante</th>
                      <th data-field="name" data-formatter="nameFormatter">Ubicacion</th>
                      <th data-field="name" data-formatter="nameFormatter">Proveedor</th>
                      <th data-field="name" data-formatter="nameFormatter">Estado</th>
                      <th scope="col">Opciones</th>

                    </thead>
                    <tbody id="productos" class="buscar">
                                    
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

