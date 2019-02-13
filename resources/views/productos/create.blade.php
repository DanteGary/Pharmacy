<div class="modal fade" id="create-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro Compra de Producto</h4>
      </div>
    <div class="modal-body">
        <form data-toggle="validator" action="{{ route('productos.store') }}" method="POST">
          {{ csrf_field() }}    
            <div class="form-group">
               <label class="control-label" for="nombre">Nombre:</label>
               <input type="text" name="nombre" placeholder="nombre" class="form-control" data-error="ingrese nombre." required />
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="marca">Marca:</label>
               <input type="text" name="marca" class="form-control" placeholder="marca" data-error="ingrese marca." required />
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="cantidad">Cantidad:</label>
               <input type="number" placeholder="cantidad" name="cantidad" class="form-control" data-error="ingrese cantidad." required />
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="descripcion">Descripción:</label>
               <input type="text" name="descripcion" placeholder="descripciòn" class="form-control" data-error="ingrese descripción." required />
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="preciounitario">Prec.Unit para Venta:</label>
               <input type="text" placeholder="precio unitario para Venta" name="preciounitario" class="form-control" data-error="ingrese precio Unit. de venta." required />
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="preciocompra">Prec.Unit de Compra:</label>
               <input type="text" placeholder="precio Unit de compra" name="preciocompra" class="form-control" data-error="ingrese preciocompra." required />
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="fechavence">Fecha Vencimiento:</label>
               <input type="date" placeholder="fecha vencimiento" name="fechavence" class="form-control" data-error="ingrese fecha que vence." />
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="id_cat">categoria:</label>
               <select class="form-control selectpicker " data-live-search=("true") name="id_cat" data-error="selccione categoria" required>
                 
                     @foreach($categories as $cat)
                  <option value={{$cat->id}}>{{$cat->nombre}}</option>
                     @endforeach
               </select>
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="id_estante">Proveedor:</label>
               <select class="form-control selectpicker" data-live-search=("true") name="id_proveedor" data-error="selccione proveedor" required>
                  
                     @foreach($proveedors as $prov)
                  <option value={{$prov->id}}>{{$prov->nombre}}</option>
                     @endforeach
               </select>
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <label class="control-label" for="id_estante">Estante:</label>
                  <select class="form-control selectpicker " data-live-search=("true") name="id_estante" data-error="selccione estante" required>
                     
                        @foreach($estantes as $est)
                     <option value={{$est->id}}>Estante:{{$est->nombre}} -> {{$est->ubicacion}}</option>
                        @endforeach
                  </select>
               <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
               <button class="btn producto-submit btn-success">Guardar</button>
            </div>
         </form>
      </div>
   </div>
   </div>
</div>