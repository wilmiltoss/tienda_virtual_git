
<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form id="formPerfil" name="formPerfil" class="form-horizontal">
                <input type="hidden" id="idUsuario" name="idUsuario" value="">
                <p class="text-primary">Los capos con asterisco (<span class="required">*</span>) son obligatorios. </p>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="txtIdentificacion">Identificación <span class="required">*</span></label>      
                    <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" value="<?php $_SESSION['userData']['identificacion']; ?>" required="">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="txtNombre">Nombres <span class="required">*</span></label>      
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" value="<?php $_SESSION['userData']['nombres']; ?>" required="">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="txtApellido">Apellidos <span class="required">*</span></label>      
                    <input type="text" class="form-control" id="txtApellido" name="txtApellido" value="<?php $_SESSION['userData']['apellidos']; ?>" required="">
                  </div>
                </div>

                 <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="txtTelefono">Telefono <span class="required">*</span></label>      
                      <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" value="<?php $_SESSION['userData']['telefono']; ?>" required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="txtEmail">Email</label>      
                      <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php $_SESSION['userData']['email_user']; ?>" required="" readonly disabled >
                    </div>
                  </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label class="txtPassword">Password</label>      
                    <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="txtPassword">Confirmar Password</label>      
                    <input type="password" class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm">
                  </div>
                </div>
        

                  <div class="tile-footer">
                    <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span> </button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                  </div>
              </form>
      </div>
    </div>
  </div>
</div>