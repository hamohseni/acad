<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear Año Academico<?php echo $this->mensaje;?></h1>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>anoacademico/registrarAno">
        <input  type="text" name="nombre" placeholder="Nombre"/><br><br>
        <br>
        <br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>
    <h1>Crear Periodo Academico<?php echo $this->mensaje;?></h1>
    
    <form enctype="multipart/form-data" method="post" action="<?php echo constant('URL');?>anoacademico/registrarPeriodo">
        <input  type="text" name="nombre" placeholder="Nombre"/><br><br>
        <br>
        <br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>

    <ul>
    <?php
        include_once 'entidades/ano.php';
        foreach($this->anos as $row){
            $ano = new Ano();
            $ano = $row; 
    ?>
    <li>
        <?php
            echo $ano->nombre; 
        ?>
        <ol>
            <?php
                include_once 'entidades/ano_has_periodo.php';
                foreach($this->anos_has_periodos as $row ){
                    $ano_has_periodo = new Ano_has_periodo();
                    $ano_has_periodo = $row; 
                    if($ano_has_periodo->ano == $ano->id ){
            ?>
            <li>
                <?php
                        echo $ano_has_periodo->nombre; 
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