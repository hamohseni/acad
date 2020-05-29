<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>main/ingresar">
        <label>Usuario</label>
        <input  name="usuario" type="text" placeholder="Usuario" autofocus required /><br><br>
        <label>Password</label>
        <input name="contrasena" type="password" placeholder="Password"  required/><br><br>    
        <input type="submit" name="ingresar" value="Ingresar">
    </form>
</body>
</html>

