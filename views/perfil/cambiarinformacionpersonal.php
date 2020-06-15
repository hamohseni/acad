<?php
    include 'views/header.php';
    include_once 'views/final.php';
    include_once 'entidades/persona_has_permiso.php'; 
    if(($this->permisos)==0){
        exit('Acceso denegado');
    }else{
        include_once 'entidades/persona.php';
        foreach($this->personas as $row){
            $Persona = new Persona();
            $Persona = $row;
            include_once 'views/menus.php';
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo constant("URL");?>main">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo constant("URL");?>perfil">Perfil</a></li>
              <li class="breadcrumb-item active">Editar</li>
            </ol>
          </div>
        </div>
      </div>
    </div> 
    <section class="content">
      <div class="container-fluid">
        <?php echo $this->mensaje; ?>
        <div class="row">
          <div class="col-md-12">
          <form   enctype="multipart/form-data" method="POST" action="<?php echo constant('URL'); ?>perfil/actualizarInformacionPersonal/">
            <div class="card card-primary ">
              <div class="card-header">
                <h3 class="card-title">Información</h3>
              </div>
              <div class="row" >
                <div class="col-sm-6">
                  <div class="card-body ">
                  <?php
                        if(($this->permisoimagen)==1){
                    ?>  
                  <strong><i class="fas fa-image mr-1"></i>Imagen</strong>                  
                    <p class="text-muted">
                    <div class="form-group">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="uploadedfile">
                        <label class="custom-file-label" for="exampleInputFile" data-browse="Seleccionar">Seleccionar archivo</label>
                      </div>
                    </div>
                    </div>
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisonombre)==1){
                    ?>
                    <strong><i class="fas fa-calendar-alt mr-1"></i>Nombre</strong>
                    <p class="text-muted">
                        <input type="text" class="form-control form-control-sm" name="nombre" value="<?php echo $this->persona->nombre; ?>">
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisopais)==1){
                    ?> 
                    <strong><i class="fas fa-globe-americas mr-1"></i>País</strong>                   
                    <p class="text-muted">
                      <input type="text" class="form-control form-control-sm" name="pais" value="<?php echo $this->persona->pais; ?>">
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisociudad)==1){
                    ?>
                    <strong><i class="fas fa-city mr-1"></i>Ciudad</strong>
                    <p class="text-muted">
                      <input type="text" class="form-control form-control-sm" name="ciudad" value="<?php echo $this->persona->ciudad; ?>">
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisodireccion)==1){
                    ?>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Direcci&oacute;n</strong>
                    <p class="text-muted">
                      <input type="text" class="form-control form-control-sm" name="direccion" value="<?php echo $this->persona->direccion; ?>">
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisocorreo)==1){
                    ?>
                    <strong><i class="fas fa-envelope mr-1"></i>Correo</strong>
                    <p class="text-muted">
                      <input type="text" class="form-control form-control-sm" name="correo" value="<?php echo $this->persona->correo; ?>">
                    </p>
                    <?php
                        }
                    ?>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card-body ">
                  <?php
                      if(($this->permisotipodocumento)==1 | ($this->permisoidentificacion)==1){
                  ?>
                    <strong><i class="fas fa-id-badge mr-1"></i>Identificacion</strong>
                  <?php
                      }
                  ?>
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <?php
                      if(($this->permisotipodocumento)==1){
                    ?>
                        <select name="tipodocumento" class="form-control">
                            <?php
                                $cedulac = "Cedula Ciudadania";
                                $cedulae = "Cedula Extranjeria";
                                $pasaporte= "Pasaporte";
                                $tarjeta = "Tarjeta de Identidad";
                                $selected1="";
                                $selected2="";
                                $selected3="";
                                $selected4="";
                                if($this->persona->tipodocumento == $cedulac){
                                    $selected1 = "selected";
                                }
                                if($this->persona->tipodocumento == $cedulae){
                                    $selected2 = "selected";
                                }
                                if($this->persona->tipodocumento == $pasaporte){
                                    $selected3 = "selected";
                                }
                                if($this->persona->tipodocumento == $tarjeta){
                                    $selected4 = "selected";
                                }
                            ?>
                            <option value="Cedula Ciudadania" <?php echo $selected1; ?>>Cedula Ciudadania</option>
                            <option value="Cedula Extranjeria" <?php echo $selected2; ?>>Cedula Extranjeria</option>
                            <option value="Pasaporte" <?php echo $selected3; ?>>Pasaporte</option>
                            <option value="Tarjeta de Identidad" <?php echo $selected4; ?> >Tarjeta de Identidad</option>
                        </select>
                        <?php
                            }
                        ?>
                    </div>
                        <?php 
                            if(($this->permisoidentificacion)==1){
                        ?>
                        <input type="text" class="form-control" name="identificacionnueva" value="<?php echo $this->persona->identificacion; ?>">
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        if(($this->permisotipodocumento)==1 | ($this->permisoidentificacion)==1){
                    ?>
                    <hr>
                    <?php
                        }if(($this->permisoapellido)==1){
                    ?>
                    <strong><i class="fas fa-calendar-alt mr-1"></i>Apellido</strong>
                    <p class="text-muted">
                        <input type="text" class="form-control form-control-sm" name="apellido" value="<?php echo $this->persona->apellido; ?>">
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisonacimiento)==1){
                    ?>
                    <strong><i class="fas fa-calendar-alt mr-1"></i>Fecha de nacimiento</strong>
                    <p class="text-muted">
                      <input type="date" class="form-control form-control-sm" name="nacimiento" value="<?php echo $this->persona->nacimiento; ?>">
                    </p>  
                    <hr> 
                    <?php
                        }if(($this->permisocelular)==1){
                    ?>                   
                    <strong><i class="fas fa-mobile mr-1"></i>Celular</strong>                 
                    <p class="text-muted">
                      <input type="text" class="form-control form-control-sm" name="celular" value="<?php echo $this->persona->celular; ?>">
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisotelefono)==1){
                    ?>
                    <strong><i class="fas fa-phone-alt mr-1"></i>Tel&eacute;fono</strong>
                    <p class="text-muted">
                      <input type="text" class="form-control form-control-sm" name="telefono" value="<?php echo $this->persona->telefono; ?>">
                    </p>
                    <hr>
                    <?php
                        }if(($this->permisoactualizar)==1){
                    ?>
                    <strong><i class="fas fa-sync-alt mr-1"></i>Actualizar</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn btn-block btn-success btn-lg" type="submit" value="Actualizar" name="submit">
                    </p>
                    <?php
                        }
                    ?>
                  </div>
                </div>
              </div>
            </div> 
            </form>        
          </div>
        </div>      
      </div>
    </section>
  </div>
<?php
      }
    }
    echo $final;
?>