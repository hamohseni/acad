<?php
    include 'views/header.php';
    include_once 'views/final.php';
    include 'views/perfil/cambiarcontrasena.php';
    include_once 'entidades/persona_has_permiso.php'; 
    if(($this->permisos)==0){
        exit('Acceso denegado por permiso');
    }else{
        include_once 'entidades/persona.php';
        foreach($this->personas as $row){
            $Persona = new Persona();
            $Persona = $row;
            include_once 'views/menus.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perfil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  
    <?php echo $this->mensaje; ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
                  <!-- /.card-header -->            
          <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title">Hola <?php echo $Persona->nombre;?></h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#password">
                    <a href="#">
                      <i class="fas fa-lock"></i>
                    </a>
                  </button>
                  <button type="button" class="btn btn-tool">
                    <a href="<?php echo constant('URL')?>perfil/editarinformacionpersonal">
                      <i class="fas fa-tools"></i>
                    </a> 
                  </button>
                </div>
              </div>

                  <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background: url('<?php echo constant('URL')?>public/imgs/perfil/1020847034/fondo.png') center center;">
                <h3 class="widget-user-username text-right mt-4"><?php echo $Persona->nombre;?> <?php echo $Persona->apellido;?></h3>
                <h5 class="widget-user-desc text-right">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="<?php echo constant('URL')?>public/imgs/perfil/<?php echo $Persona->identificacion;?>/<?php echo $Persona->imagen;?>" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row mt-5">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $Persona->codigo;?></h5>
                      <span class="description-text">Codigo</span>
                    </div>
                        <!-- /.description-block -->
                  </div>
                      <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $Persona->ciudad;?></h5>
                      <span class="description-text">Ciudad</span>
                    </div>
                        <!-- /.description-block -->
                  </div>
                      <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $Persona->celular;?></h5>
                      <span class="description-text">Celular</span>
                    </div>
                        <!-- /.description-block -->
                  </div>
                      <!-- /.col -->
                </div>
                    <!-- /.row -->
              </div>
            </div>
                <!-- /.widget-user -->
          </div>
            

          
          <div class="col-md-12">
            <div class="card card-primary ">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
                <!-- /.card-header -->
              <div class="row" >
                <div class="col-sm-6">
                  <div class="card-body ">
                    <strong><i class="fas fa-globe-americas mr-1"></i>País</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->pais;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-city mr-1"></i>Ciudad</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->ciudad;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i>Direcci&oacute;n</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->direccion;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-envelope mr-1"></i>Correo</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->correo;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-phone-alt mr-1"></i>Tel&eacute;fono</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->telefono;?>
                    </p>
                  </div>   <!-- /.card-body -->
                </div>
                 <!-- /.col -->
                <div class="col-sm-6">
                  <div class="card-body ">
                    <strong><i class="fas fa-user mr-1"></i> Codigo</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->codigo;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-id-badge mr-1"></i><?php echo $Persona->tipodocumento;?></strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->identificacion;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-calendar-alt mr-1"></i>Fecha de nacimiento</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->nacimiento;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-calendar-check mr-1"></i>Fecha Ingreso</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Persona->ingreso;?>
                    </p>
                    <hr>
                    <strong><i class="fas fa-mobile mr-1"></i>Celular</strong>
                    <p class="text-muted">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp<?php echo $Persona->celular;?>
                    </p>
                  </div>   <!-- /.card-body -->
                </div>
                        <!-- /.col -->
              </div>
            </div>         
          </div>
        </div>    
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->    
    

<?php  
    
        }
    }
    echo $final;
?>