
      <div class="modal fade" id="capacity-edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Editar Capacidad</h4>
            </div>
            <div class="modal-body">
      
                  <form data-toggle="validator" action="/item-ajax/14" method="put">
                     <div class="form-group">
                        <label class="control-label" for="nombre">nombre:</label>
                           <input type="text" name="nombre" class="form-control" data-error="nombre." required />
                        <div class="help-block with-errors"></div>
                     </div>
                     
                     <div class="form-group">
                        <label class="control-label" for="unidadMedida">Unidad Medida:</label>
                           <input type="text" name="unidadMedida" class="form-control" data-error="Unidad de medida." required />
                        <div class="help-block with-errors"></div>
                     </div>
                     
                     <div class="form-group">
                        <button type="submit" class="btn btn-success capacity-submit-edit">Guardar</button>
                     </div>
                  </form>
      
            </div>
          </div>
        </div>
      </div>