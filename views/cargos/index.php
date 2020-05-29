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
        <input type="submit" value="Crear">
    </form>
</body>
</html>