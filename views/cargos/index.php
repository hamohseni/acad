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
    <form method="POST" action="<?php echo constant('URL');?>cargos/registrarCargo">
        <?php echo $this->mensaje;?><br><br>
        <label>Cargo</label>
        <input type="text" name="cargo"><br><br>
        <input type="submit" name="crear" value="Crear">
    </form>
</body>
</html>
<?php
    }
?>