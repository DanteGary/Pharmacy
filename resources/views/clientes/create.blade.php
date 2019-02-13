<div class="modal modal-cli fade" id="create-cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Registro Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
      
                    <form data-toggle="validator" action="{{ route('clientes.store') }}" method="POST">
                            {{ csrf_field() }}    
                        <div class="form-group">
                              <label class="control-label" for="nombre">nombre:</label>
                                 <input type="text" name="nombre" class="form-control" data-error="nombre." required />
                              <div class="help-block with-errors"></div>
                          </div>
                         <div class="form-group">
                             <label class="control-label" for="direccion">Apellidos:</label>
                              <input type="text" name="apellidos" class="form-control" data-error=" ingrese Apellidos." />
                             <div class="help-block with-errors"></div>
                         </div>
                      <div class="form-group">

                        <label class="control-label" for="nit">nit:</label>
                           <input type="number" name="nit" class="form-control" data-error="nit." required />
                        <div class="help-block with-errors"></div>
                      </div>
                     <input type="hidden" name="estado" value="0">
                      <div class="form-group">
                          <button type="submit" class="btn cliente-submit btn-success">Guardar</button>
                      </div>
                    </form>
            </div>
          </div>
        </div>
      </div>