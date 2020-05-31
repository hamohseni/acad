<?php
    include_once 'entidades/persona_has_permiso.php'; 
    if(($this->permisos)==0){
        exit('Acceso denegado');
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div><?php echo $this->mensaje; ?></div>
    <form   enctype="multipart/form-data" method="POST" action="<?php echo constant('URL'); ?>perfil/actualizarInformacionPersonal/">
        <?php
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisonombre)==1){
        ?>
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="<?php echo $this->persona->nombre; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisoapellido)==1){
        ?>
        <label for="">Apellido</label>
        <input type="text" name="apellido" value="<?php echo $this->persona->apellido; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisoimagen)==1){
        ?>
        <label for="">Imagen</label>
        <input type="file" name="uploadedfile"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisotipodocumento)==1){
        ?>
        <label for="">Tipo de Documento</label>
        <select name="tipodocumento">
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
        </select><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisoidentificacion)==1){
        ?>
        <label for="">Identificacion</label>
        <input type="text" name="identificacion" value="<?php echo $this->persona->identificacion; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisotelefono)==1){
        ?>
        <label for="">Telefono</label>
        <input type="text" name="telefono" value="<?php echo $this->persona->telefono; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisocelular)==1){
        ?>
        <label for="">Celular</label>
        <input type="text" name="celular" value="<?php echo $this->persona->celular; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisodireccion)==1){
        ?>
        <label for="">Direccion</label>
        <input type="text" name="direccion" value="<?php echo $this->persona->direccion; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisocorreo)==1){
        ?>
        <label for="">Correo</label>
        <input type="text" name="correo" value="<?php echo $this->persona->correo; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisopais)==1){
        ?>
        <label for="">Pais</label>
        <input type="text" name="pais" value="<?php echo $this->persona->pais; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisociudad)==1){
        ?>
        <label for="">Ciudad</label>
        <input type="text" name="ciudad" value="<?php echo $this->persona->ciudad; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisonacimiento)==1){
        ?>
        <label for="">Fecha de Nacimiento</label>
        <input type="date" name="nacimiento" value="<?php echo $this->persona->nacimiento; ?>"><br><br>
        <?php
            }
            include_once 'entidades/persona_has_permiso.php'; 
            if(($this->permisoactualizar)==1){
        ?>
        <input type="submit" value="Actualizar">
        <?php
            }
        ?>
    </form>
</body>
</html>
<?php
    }
?>