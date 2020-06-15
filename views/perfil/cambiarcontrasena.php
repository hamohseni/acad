<?php
include_once 'entidades/persona_has_permiso.php';
  if (($this->permisos) == 0) {
    exit('Acceso denegado');
  } else {
?>




  <!-- Modal -->
  <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <h5  class="modal-title mx-auto" id="exampleModalLabel">Cambiar Contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          <form method="POST" action="<?php echo constant('URL'); ?>perfil/actualizarContrasena/">
            <div class="wrap-input100 validate-input" data-validate="Password is required">
              <input class="input100" type="password" name="contrasenaactual" placeholder="Contraseña Actual">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
              <input class="input100" type="password" name="contrasenanueva" placeholder="Contraseña Nueva">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
              <input class="input100" type="password" name="confirmarcontrasenanueva" placeholder="Confirmar Contraseña">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>
            <div class="container-login100-form-btn">
              <input class="login100-form-btn" id="submit" type="submit" name="ingresar" value="Actualizar"></input>
            </div>
          </form>
        </div>  
      </div>
    </div>
  </div>



<?php
}
?>