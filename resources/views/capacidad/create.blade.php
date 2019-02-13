<div class="modal modal fade" id="create-capacity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Registro Capacidad</h4>
            </div>
            <div class="modal-body">
      
                    <form data-toggle="validator" action="{{ route('capacity.store') }}" method="POST">
                            {{ csrf_field() }}    
                        <div class="form-group">
                              <label class="control-label" for="nombre">Nombre:</label>
                                 <input type="text" name="nombre" class="form-control" data-error="nombre." required />
                              <div class="help-block with-errors"></div>
                          </div>
                        
                          <div class="form-group">
                              <label class="control-label" for="unidadMedida">Unidad de Medida:</label>
                                 <input type="text" name="unidadMedida" class="form-control" data-error="unidadMedida." required />
                              <div class="help-block with-errors"></div>
                          </div>
                      
                      <div class="form-group">
                          <button type="submit" class="btn capacity-submit btn-success">Registrar</button>
                      </div>
                    </form>
            </div>
          </div>
        </div>
      </div>