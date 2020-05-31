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
    <form method="POST" action="<?php echo constant('URL'); ?>perfil/actualizarContrasena/">
        <label for="">Contraseña Actual:</label>
        <input type="text" name="contrasenaactual"><br><br>
        <label for="">Contraseña Nueva:</label>
        <input type="text" name="contrasenanueva"><br><br>
        <label for="">Confirmar Contraseña Nueva:</label>
        <input type="text" name="confirmarcontrasenanueva"><br><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
<?php
    }
?>