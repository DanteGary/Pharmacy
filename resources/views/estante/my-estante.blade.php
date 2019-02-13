@extends('layouts.admin')
@section('contenidoes')

<div class="container">
    <h1>Estantes <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-estante"><i class="fa fa-plus-square"></i></button></h1>
    <div class="row">
            <div class="col-xs-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Nombre</th>
                      <th>Ubicacion</th>
                    </thead>
                    <tbody id="estante" class="buscar">
                        
                    </tbody>
                </table>
                <ul id="pagination" class="pagination-sm"></ul>
                @include('estante.create')
                @include('estante.edit')      
                @include('estante.delete')      
              </div>
            </div>
    </div>
</div>
@endsection

                