<div class="modal fade bd-example-modal-lg" id="create-venta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <style media="print" type="text/css">
          h3{display: none;}
        </style>
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h2 class="modal-title" id="myModalLabel">Registro Venta</h2>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6 col-xs-12 col-lg-6">
                <div style="font-size: 12px;" class="alert alert-warning">
                      <strong>Opcional!</strong> Seleccione Cliente, si no existe puede agregar con el boton Nuevo.
                    </div>
                  <div class="col-md-8 col-xs-8"
                        >
                        <div class="form-group">
                                <div class="form-group">
                                <label class="control-label" for="id_client">Cliente:</label>
                                <select id="Select" class="form-control selectpicker " data-live-search="true" name="id_client" data-error="selccione Producto" >
                                <option value="1">Nombre: Sin Nombre Nit: 0</option>
                                
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          </div>
                          <div class="col-md-4 col-xs-4">
                              <h1><button style="margin-top:4px; width: 80px;height: 40px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#create-cliente"><i class="fa fa-plus-square"></i> Nuevo</button></h1>
                          </div>
                </div>
                <div class="col-md-6 col-xs-12 col-lg-6">
                <div style="font-size: 12px;" class="alert alert-info">
                      <strong>Requerido..!</strong> Seleccione producto a ser vendido y agreguelo a la lista con el boton Agregar.
                    </div>
                    <div class="col-md-4 col-xs-4">  
                            <div class="form-group">
                                <label class="control-label" for="id_producto">Producto:</label>
                                <select  id="prostock" class="form-control selectpicker " data-live-search="true" name="id_pro" data-error="selccione Producto" required>
                                <option value="">Seleccione</option>
                              
                              @foreach($venta as $prod)
                              @if($prod->cantidad > 0)
                              <option value={{$prod->id}}>
                                {{$prod->nombre}} -> {{$prod->descripcion}} [ cantidad {{$prod->cantidad}} ] precio U: {{$prod->preciounitario}} Bs.-
                                </option>
                              @endif
                              @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                          </div>
                            <div class="col-md-4 col-xs-4">
                              <div class="form-group">
                                <label class="control-label" for="cantidad">Cantidad:</label>
                                <input style="font-size: 20px; height: 40px;" type="number" name="cantidad" value="1" class="form-control" data-error="ingrese cantidad a comprar" required />
                                <div class="help-block with-errors"></div>
                              </div>
                            </div>
                            <div class="col-md-4 col-xs-4">
                              <br>
                                <button class="btn btn-primary" style="margin-top:4px; width: 80px;height: 40px;" id="add" onClick="nuevo({{$venta}})"><i class="fa fa-plus-square"></i> Agregar</button>
                            </div>
                </div> 
              </div>
              <div class="row">
                <div class="col-md-12 col-xs-12 col-lg-6">
                  
                      <hr style="color: #0056b2;" />
                      <div style="font-size: 12px;" class="alert alert-success">
                      <strong>Info!</strong> Coloque la información para Hacer el cobro solo si agregó productos.
                    </div>
                     <div class="col-md-4 col-xs-4">
                          <div class="form-group">
                                <label class="control-label" for="efectivo">Efectivo en Bs:</label>
                                <input id="efectivo" style="height: 60px;font-size: 20px;" type="number" name="efectivo" value="0" class="form-control" data-error="ingrese cantidad a comprar" required />
                                <div class="help-block with-errors"></div>
                              </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                          <div class="form-group">
                                <label class="control-label" for="cantidad">Cambio en Bs:</label>
                                <input id="cambio" style="height: 40px; font-size: 20px;" type="number" name="cantidad" value="0" class="form-control" data-error="ingrese cantidad a comprar" readonly="readonly" />
                                <div class="help-block with-errors"></div>
                              </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                           <div class="form-group">
                           <br>
                          <button style="font-size: 20px; margin-top:4px; width: 80px;height: 40px;"  class="btn venta-submit btn-success" >Cobrar</button>
                      </div>
                        </div>
                </div>
                <div class="col-md-12 col-xs-12 col-lg-6">
                   <hr style="color: #0056b2;" />
                      <div style="font-size: 12px;" class="alert alert-warning">
                      <strong>Info!</strong> Aquí puede ver los productos agregados, tambien quitarlos.
                    </div>
                        <form data-toggle="validator" action="{{ route('venta.store') }}" method="POST">
                            {{ csrf_field() }}   
                          <div class="row" id="">
                              <div class="col-xs-12">
                                <div class="table-responsive">
                                  <table border="1px" class="table table-striped table-bordered table-condensed table-hover">
                                      <thead>
                                        <th>Cantidad</th>
                                        <th>Concepto</th>
                                        <th>Precio Unitario</th>
                                        <th>SubTotal</th>
                                      </thead>
                                      <tbody id="carrito">
                                        
                                      </tbody>
                                  </table>                                  
                                </div>
                              </div>
                          </div>
                      </form>  
                </div> 
              </div>
                      
                     
                    <input id="total" type="hidden" name="">
            </div>
          </div>
        </div>
      </div>
