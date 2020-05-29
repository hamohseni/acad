<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
    <?php
        include_once 'entidades/materia.php';
        foreach($this->materias as $row){
            $materia = new Materia();
            $materia = $row; 
    ?>
    <li>
        <?php
            echo $materia->nombre; 
        ?>
        <ol>
        <?php
            include_once 'entidades/asignatura.php';
            foreach($this->asignaturas as $row ){
                $asignatura = new Asignatura();
                $asignatura = $row; 
                if($asignatura->materia == $materia->id ){
        ?>
            <li>
                <?php
                        echo $asignatura->nombre; 
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
    <h1>Crear Materia</h1>
    <h1><?php echo $this->mensaje;?></h1>
    <form method="post" action="<?php echo constant('URL');?>vermateria/registrarMateria">
        <input type="text" name="nombre" placeholder="Nombre" />
        <input type="submit" name="crear" value="Crear"></p>
    </form>
    <h1>Crear Asignatura</h1>
    <form method="post" action="<?php echo constant('URL');?>vermateria/registrarAsignatura">
        <select name="materia" >
            <option value="NULL">--Materia--</option>
            <?php
                include_once 'entidades/materia.php';
                foreach($this->materias as $row){
                $materia = new Materia();
                $materia = $row; 
            ?>
            <option value="<?php echo $materia->id;?>"><?php echo $materia->nombre; ?></option>
            <?php 
                } 
            ?>
        </select>
        <input type="text" name="nombre" placeholder="Nombre"/>
        <select name="rotativo" >
            <option value="NULL">--Rotativo--</option>
            <option value="0">NO</option>
            <option value="1">SI</option>
        </select>
        <input type="submit" name="crear" value="Crear"></p>
    </form>
</body>
</html>