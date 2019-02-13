<div class="modal fade" id="renovar-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Comprar Producto</h4>
        </div>
        <div class="modal-body">
              <input id="hri" type="hidden" name="hri">
               <input id="cant" type="hidden" name="cant">
              <form data-toggle="validator" action="{{ route('productos.store') }}" method="POST">
                 <div class="form-group">
                    <label class="control-label" for="nombre">nombre:</label>
                       <input type="text" name="nombre" class="form-control" data-error="nombre." required />
                    <div class="help-block with-errors"></div>
                 </div>
                 <div class="form-group">
                    <label class="control-label" for="marca">Marca:</label>
                       <input type="text" name="marca" class="form-control" data-error="ingrese marca." required />
                    <div class="help-block with-errors"></div>
                 </div>
                 <div class="form-group">
                    <label class="control-label" for="title">Cantidad:</label>
                       <input type="text" name="cantidad" class="form-control" data-error="Please enter cantidad." required></input>
                    <div class="help-block with-errors"></div>
                 </div>
                 <div class="form-group">
                          <label class="control-label" for="descripcion">descripcion:</label>
                             <input type="text" name="descripcion" class="form-control" data-error="descripcion." required />
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="preciounitario">Precio Unitario:</label>
                             <input type="text" name="preciounitario" class="form-control" data-error="ingrese preciounitario." required />
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="preciocompra">Precio Compra:</label>
                             <input type="text" name="preciocompra" class="form-control" data-error="ingrese preciocompra." required />
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="fechavence">Fecha Vencimiento:</label>
                             <input type="date" name="fechavence" class="form-control" data-error="fechavence." />
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="id_cat">categoria:</label>
                          <select class="form-control" name="id_cat" data-error="selccione categoria" required>
                          @foreach($categories as $cat)
                            <option value={{$cat->id}}>{{$cat->nombre}}</option>
                          @endforeach
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="id_estante">Proveedor:</label>
                             <select class="form-control" name="id_proveedor" data-error="Selccione Proveedor" required>
                          @foreach($proveedors as $prov)
                            <option class="proveedors" value={{$prov->id}}>{{$prov->nombre}}</option>
                          @endforeach
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="id_estante">Estante:</label>
                              <select class="form-control" name="id_estante" data-error="Selccione Estante" required>
                          @foreach($estantes as $est)
                            <option value={{$est->id}}>Estante:{{$est->nombre}} -> {{$est->ubicacion}}</option>
                          @endforeach
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                 <div class="form-group">
                    <button type="submit" class="btn btn-success renovar-submit">Renovar</button>
                 </div>
              </form>
  
        </div>
      </div>
    </div>
  </div>