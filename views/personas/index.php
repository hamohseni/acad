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
    <title>Crear Persona</title>
</head>
<body>
    <form enctype="multipart/form-data" method='POST' action="<?php echo constant('URL');?>personas/registrarPersona">
        <?php echo $this->mensaje;?><br><br>
        <select name="cargo" >
            <option value="NULL">--Cargo--</option>
            <?php
                include_once 'entidades/cargo.php';
                foreach($this->cargos as $row){
                $Cargo = new Cargo();
                $Cargo = $row; 
            ?>
            <option value="<?php echo $Cargo->id;?>"><?php echo $Cargo->nombre; ?></option>
            <?php 
                } 
            ?>
        </select><br><br>
        <label>Nombre</label>
        <input type="text" name="nombre" ><br><br>
        <label>Apellido</label>
        <input type="text" name="apellido" ><br><br>
        <label >Imagen</label>
        <input type="file" name="uploadedfile" /><br><br>
        <label>Tipo Documento</label>
        <select name="tipodocumento">
            <option value="Cedula Ciudadania">Cedula Ciudadania</option>
            <option value="Cedula Extranjeria">Cedula Extranjeria</option>
            <option value="Pasaporte">Pasaporte</option>
            <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
        </select>
        <label>Identificacion</label>
        <input type="number" name="identificacion" ><br><br>
        <label>Telefono</label>
        <input type="nomber" name="telefono"><br><br>
        <label>Celular</label>
        <input type="number" name="celular"><br><br>
        <label>Correo</label>
        <input type="email" name="correo" ><br><br>
        <label>Codigo</label>
        <input type="number" name="codigo" ><br><br>
        <label>Direccion</label>
        <input type="text" name="direccion"><br><br>
        <label>Pais</label>
        <input type="text" name="pais" ><br><br>
        <label>Ciudad</label>
        <input type="text" name="ciudad" ><br><br>
        <label>Fecha de Nacimiento</label>
        <input type="date" name="nacimiento" ><br><br>
        <label>Contraseña</label>
        <input type="text" name="contrasena" ><br><br>
        <input type="submit" value="Crear" name="crear" >
    </form>
</body>
</html>
<?php
    }
?>