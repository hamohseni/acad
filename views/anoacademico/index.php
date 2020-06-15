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
    <h1>Crear Año Academico<?php echo $this->mensaje;?></h1>
    
    <form method="post" action="<?php echo constant('URL');?>anoacademico/registrarAno">
        <label for="">Nombre</label>
        <input  type="text" name="nombre" /><br><br>
        <label for="">Fecha Inicial</label>
        <input  type="date" name="fecha_inicial" /><br><br>
        <label for="">Fecha Final</label>
        <input  type="date" name="fecha_final" /><br><br>
        <label for="">Estado</label>
        <select name="estado" >
            <option value="0" selected>Desactivo</option>
            <option value="1">Activo</option>
            <option value="2">Terminado</option>
        </select><br><br>
        <br>
        <br>
        <input type="submit" name="crear" value="Crear"></p> 
    </form>
    <h1>Crear Periodo Academico<?php echo $this->mensaje;?></h1>
    
    <form method="post" action="<?php echo constant('URL');?>anoacademico/registrarPeriodo">
    <label for="">Nombre</label>
        <input  type="text" name="nombre" /><br><br>
        <label for="">Fecha Inicial</label>
        <input  type="date" name="fecha_inicial" /><br><br>
        <label for="">Fecha Final</label>
        <input  type="date" name="fecha_final" /><br><br>
        <label for="">Estado</label>
        <select name="estado" >
            <option value="0" selected>Desactivo</option>
            <option value="1">Activo</option>
            <option value="2">Terminado</option>
        </select><br><br>
        <label for="">Copiar Grados</label>
        <input type="checkbox" name="grados" value="1" checked/><br><br>
        <label for="">Copiar Profesores</label>
        <input type="checkbox" name="profesor" value="1" checked/><br><br>
        <label for="">Copiar Estudiantes</label>
        <input type="checkbox" name="estudiante" value="1" checked/><br><br>
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
                echo $ano->nombre,$ano->fechainicial,$ano->fechafinal,$ano->estado;
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
                            echo $ano_has_periodo->periodonombre,$ano_has_periodo->periodofechainicial,$ano_has_periodo->periodofechafinal,$ano_has_periodo->periodoestado;
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
<?php
    }
?>