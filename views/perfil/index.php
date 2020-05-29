<?php
    include_once 'entidades/persona_has_permiso.php'; 
    if(($this->permisos)==0){
        exit('Acceso denegado por permiso');
    }else{
        include_once 'entidades/persona.php';
        foreach($this->personas as $row){
            $Persona = new Persona();
            $Persona = $row;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>

    

        <tr align="left">
            <td rowspan="10"><img src="public/imgs/usuarios/<?php echo $Persona->imagen;?>" style="width: 250px;height: 250px;"></td>
        </tr>
        <tr align="left">
            <td><b>Nombre</b>:</td>
            <td><?php echo $Persona->nombre;?></td>
        </tr>
        <tr align="left">
            <td><b>Apellido</b>:</td>
            <td><?php echo $Persona->apellido;?></td>
        </tr>
        <tr align="left">
            <td><b>Codigo</b>:</td>
            <td><?php echo $Persona->codigo;?></td>
        </tr>
        <tr align="left">
            <td><b>Pais</b>:</td>
            <td><?php echo $Persona->pais;?></td>
        </tr>
        <tr align="left">
            <td><b>Ciudad</b>:</td>
            <td><?php echo $Persona->ciudad;?></td>
        </tr>
        <tr align="left">
            <td><b>Fecha Ingreso</b>:</td>
            <td><?php echo $Persona->ingreso;?></td>
        </tr>
        <tr align="left">
            <td><b> <?php echo $Persona->tipodocumento;?></b>:</td><td>
            <td><?php echo $Persona->identificacion;?></td>
        </tr>
        <tr align="left">
            <td><b>Direcci&oacute;n</b>:</td>
            <td><?php echo $Persona->direccion;?></td>
        </tr>
        <tr align="left">
            <td><b>Tel&eacute;fono</b>:</td>
            <td><?php echo $Persona->telefono;?></td>
        </tr>
        <tr align="left">
            <td><b>Celular</b>:</td>
            <td><?php echo $Persona->celular;?></td>
        </tr>
        <tr align="left">
            <td><b>Correo</b>:</td>
            <td><?php echo $Persona->correo;?></td>
        </tr>
        <tr align="left">
            <td><b>Fecha de nacimiento</b>:</td>
            <td><?php echo $Persona->nacimiento;?></td>
        </tr>
    </table>
</body>
</html>
<?php  
        }
    }
?>