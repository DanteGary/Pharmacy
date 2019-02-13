@extends('layouts.admin')
@section('contenidocat')

<div class="container">
    <h1>Categorias <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#create-categoria"> <i class="fa fa-plus-square"></i> </button></h1>
    <div class="row">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Nombre</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody id="categories" class="buscar">
                        
                    </tbody>
                </table>
                <ul id="pagination" class="pagination-sm"></ul>
                
                @include('categoria.create')
                @include('categoria.edit')      
                @include('categoria.delete')      
              </div>
            </div>
    </div>
</div>
@endsection
