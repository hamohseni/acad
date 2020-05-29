<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Asignar Asignatura a Grado<?php echo $this->mensaje;?></h1>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>asignacionmateria/asignarGradoAsignatura">
        <select name="grado" >
            <option value="NULL">--Grado--</option>
            <?php
                include_once 'entidades/grado.php';
                foreach($this->grados as $row){
                $Grado = new Grado();
                $Grado = $row; 
            ?>
            <option value="<?php echo $Grado->id;?>"><?php echo $Grado->nombre; ?></option>
            <?php 
                } 
            ?>
        </select><br><br>
        <select name="asignatura" >
            <option value="NULL">--Asignatura--</option>
            <?php
                include_once 'entidades/asignatura.php';
                foreach($this->asignaturas as $row){
                $Asignatura = new Asignatura();
                $Asignatura = $row; 
            ?>
            <option value="<?php echo $Asignatura->id;?>"><?php echo $Asignatura->nombre; ?></option>
            <?php 
                } 
            ?>
        </select><br><br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>

    <ul>
    <?php
        include_once 'entidades/grado.php';
        foreach($this->grados as $row){
            $grado = new Grado();
            $grado = $row; 
    ?>
    <li>
        <?php
            echo $grado->nombre; 
        ?>
        <ol>
            <?php
                include_once 'entidades/grado_has_asignatura.php';
                foreach($this->grados_has_asignaturas as $row ){
                    $grado_has_asignatura = new grado_has_asignatura();
                    $grado_has_asignatura = $row; 
                    if($grado_has_asignatura->grado == $grado->id ){
            ?>
            <li>
                <?php
                        echo $grado_has_asignatura->nombre; 
                ?>
            </li>
            <?php
                    }
                }
            ?>
        </ol>
    </li>
    <?php
        }
    ?>
</ul>
</body>
</html>