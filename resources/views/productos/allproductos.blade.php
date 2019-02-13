@extends('layouts.admin')
@section('allproductos')

    <h1>Productos</h1>
    
    <div class="row container">
      
            <div class="col-xs-12">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="table-primary">
                      <th scope="col">Nombre</th>
                      <th scope="col">Nombre Generio</th>
                      <th scope="col">Marca</th>
                      <th>Precio Unitario</th>
                      <th>Stock</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Estante</th>
                      <th scope="col">Ubicacion</th>
                      <th scope="col">Fecha Vencimiento</th>
                    </thead>
                    <tbody id="" class="buscar">
                              @foreach($allproductos as $all)
                              <tr> 
                                <td>{{$all->nombre}}</td>  
                                <td>{{$all->descripcion}}</td>  
                                <td>{{$all->marca}}</td>  
                                <td>{{$all->preciounitario}} Bs.-</td>
                                <td>{{$all->cantidad}} Uds.</td>  
                                <td>{{$all->nombrecat}}</td>
                                <td>{{$all->nombreST}}</td>  
                                <td>{{$all->ubicacion}}</td>  
                                <td>{{$all->fechavence}}</td>  

                              </tr>
                              @endforeach

                    </tbody>
                </table>
                <ul id="pagination" class="pagination-sm"></ul>     
              </div>
    </div>
</div>

@endsection

