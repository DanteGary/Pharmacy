<div class="modal fade" id="usuario-editPass-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Editar Password</h4>
            </div>
            <div class="modal-body">
      
                  <form data-toggle="validator" action="/item-ajax/14" method="put">
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">Password</label>
                        <div class="form-inline row">
                          <div class="form-group col-sm-6">
                            <input type="password" name="pass" data-minlength="6" class="form-control" id="inputPasswordreset" placeholder="Password" required>
                            <div class="help-block">Minimo 6 caracteres</div>
                          </div>
                          <div class="form-group col-sm-6">
                            <input type="password" class="form-control" name="pass2" id="inputPasswordConfirm" data-match="#inputPasswordreset" data-match-error="las contraseñas no coinciden" placeholder="Confirm" required>
                            <div class="help-block with-errors"></div>
                          </div>
                        </div>
                      </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-success crud-submit-usuario-editPass">Guardar</button>
                     </div>
                  </form>
      
            </div>
          </div>
        </div>
      </div>