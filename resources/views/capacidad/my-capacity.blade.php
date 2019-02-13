@extends('layouts.admin')
@section('contenidocat')

<div class="container">
    <h1>Capacidades<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-capacity">Registrar Capacidades</button></h1>
    <div class="row">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Nombre</th>
                      <th>Unidad de Medida</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody id="capacity" class="buscar">
                        
                    </tbody>
                </table>
                <ul id="pagination" class="pagination-sm"></ul>
                
                @include('capacidad.create')
                @include('capacidad.edit')      
                @include('capacidad.delete')      
              </div>
            </div>
    </div>
</div>
@endsection
