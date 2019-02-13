<div class="modal fade" id="create-proveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Registro Proveedor</h4>
            </div>
            <div class="modal-body">
      
                    <form data-toggle="validator" action="{{ route('proveedors.store') }}" method="POST">
                            {{ csrf_field() }}    
                        <div class="form-group">
                              <label class="control-label" for="nombre">nombre:</label>
                                 <input type="text" name="nombre" class="form-control" data-error="nombre." required />
                              <div class="help-block with-errors"></div>
                          </div>
                      <div class="form-group">

                        <label class="control-label" for="nit">nit:</label>
                           <input type="number" name="nit" class="form-control" data-error="nit." required />
                        <div class="help-block with-errors"></div>
                      </div>
                         <div class="form-group">
                             <label class="control-label" for="direccion">direccion:</label>
                              <textarea name="direccion" class="form-control" data-error=" direccion." required></textarea>
                             <div class="help-block with-errors"></div>
                         </div>
                     <div class="form-group">
                        <label class="control-label" for="telefono">telefono:</label>
                           <input type="text" name="telefono" class="form-control" data-error="telefono." required />
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn proveedor-submit btn-success">Submit</button>
                      </div>
                    </form>
            </div>
          </div>
        </div>
      </div>