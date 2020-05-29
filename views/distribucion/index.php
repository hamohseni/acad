<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear Nivel<?php echo $this->mensaje;?></h1>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>distribucion/registrarNivel">
        <input  type="text" name="nombre" placeholder="Nombre"/><br><br>
        <select name="estado" >
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <br>
        <br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>
    <h1>Crear Grado<?php echo $this->mensaje;?></h1>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>distribucion/registrarGrado">
        <select name="nivel" >
            <option value="NULL">--Nivel--</option>
            <?php
                include_once 'entidades/nivel.php';
                foreach($this->niveles as $row){
                $Nivel = new Nivel();
                $Nivel = $row; 
            ?>
            <option value="<?php echo $Nivel->id;?>"><?php echo $Nivel->nombre; ?></option>
            <?php 
                } 
            ?>
        </select><br><br>
        <input  type="text" name="nombre" placeholder="Nombre"/><br><br>
        <select name="estado" >
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <br>
        <br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>

    <h1>Crear Curso<?php echo $this->mensaje;?></h1>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>distribucion/registrarCurso">
        <input  type="text" name="nombre" placeholder="Nombre"/><br><br>
        <select name="estado" >
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <br>
        <br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>

    <h1>Asignar Curso a Grado<?php echo $this->mensaje;?></h1>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>distribucion/asignarCurso">
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
        <select name="curso" >
            <option value="NULL">--Curso--</option>
            <?php
                include_once 'entidades/curso.php';
                foreach($this->cursos as $row){
                $Curso = new Curso();
                $Curso = $row; 
            ?>
            <option value="<?php echo $Curso->id;?>"><?php echo $Curso->nombre; ?></option>
            <?php 
                } 
            ?>
        </select><br><br>
        <select name="estado" >
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <br>
        <br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>
<ul>
    <?php
        include_once 'entidades/nivel.php';
        foreach($this->niveles as $row){
            $nivel = new Nivel();
            $nivel = $row; 
    ?>
    <li>
        <?php
            echo $nivel->nombre; 
        ?>
        <ol>
            <?php
                include_once 'models/grado.php';
                foreach($this->grados as $row ){
                    $grado = new Grado();
                    $grado = $row; 
                    if($grado->nivel == $nivel->id ){
            ?>
            <li>
                <?php
                        echo $grado->nombre; 
                ?>
                <ul>
                    <?php
                        include_once 'models/curso_has_grado.php';
                        foreach($this->cursos_has_grados as $row){
                            $curso_has_grado = new curso_has_grado();
                            $curso_has_grado = $row; 
                            if($curso_has_grado->grado == $grado->id ){
                    ?>
                    <li>    
                        <?php
                            echo $curso_has_grado->nombre; 
                        ?>
                    </li>
                    <?php
                            }
                        } 
                    ?>
                </ul>
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