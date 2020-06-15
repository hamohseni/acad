<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .ui-helper-hidden-accessible { display:none; }
    </style>
    <script language="javascript" src="<?php echo constant("URL")?>public/avanzado/js/jquery-3.5.1.min.js"></script>
    <script language="javascript" src="<?php echo constant("URL")?>public/avanzado/js/index.js"></script>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

</head>
<body>
    <br>
    <br>
    <h1>Matricular Profesor</h1>
    <?php echo $this->mensaje;?>
    <form method="POST" action="<?php echo constant("URL")?>asignacion/asignarPersona">
        <label for="">Grado</label>
        <select name="grado" id="sel_grado_profesor">
        </select><br><br>
        <label for="">Curso</label>
        <select name="curso" id="sel_curso_profesor">
        </select><br><br>
        <select class="selectpicker " 
            data-style="form-control" 
            data-live-search="true" 
            title="-- Seleccione Persona --"
            multiple="multiple" name="persona_profesor" >
        <?php
            include_once 'entidades/persona.php';
            foreach($this->personas as $row){
            $Persona = new Persona();
            $Persona = $row; 
        ?>
        <option value="<?php echo $Persona->id;?>"><?php echo $Persona->nombre;?> | <?php echo $Persona->identificacion; ?></option>
        <?php 
            } 
        ?>
    </select><br><br>
        <label for="">Asignatura</label>
        <select name="asignatura" id="sel_asignatura_profesor">
        </select><br><br>
        <label for="">Rotativo</label>
        <input type="checkbox" name="rotativo" id="rotativo" value="1"><br><br>
        <input type="submit" value="Asignar" name="asignar">
    </form>
    <h1>Matricular Estudiante</h1>
    <form method="POST" action="<?php echo constant("URL")?>asignacion/matricularEstudiante">
        <label for="">Grado del Estudiante</label>
        <select id="sel_grado_estudiante" name="gradoantes">
        <option value="NULL">Estudiante sin Matricular</option>
        </select><br><br>
        <label for="">Curso del Estudiante</label>
        <select id="sel_curso_estudiante" name="cursoantes">
        </select><br><br>
        <select name="persona" id="sel_persona_estudiante">
        </select><br><br>
        <label for="">Grado a Matricular</label>
        <select name="grado" id="sel_grado">
        </select><br><br>
        <label for="">Curso a Matricular</label>
        <select name="curso" id="sel_curso">
        </select><br><br>
        <label for="">Graduarlos</label>
        <input type="checkbox" name="graduar" value="1"><br><br>
        <input type="submit" value="Asignar" name="asignar">
    </form>
    
</body>
</html>
<script>
        $(document).ready(function(){
            listar_grado();
            listar_grado_profesor();
            listar_grado_estudiante();
        });
        $("#sel_grado_profesor").change(function(){
            var idgrado = $("#sel_grado_profesor").val();
            listar_curso_profesor(idgrado);
            listar_asignatura_profesor(idgrado);
        })
        $("#sel_grado").change(function(){
            var idgrado = $("#sel_grado").val();
            listar_curso(idgrado);
        })
        $("#sel_grado_estudiante").change(function(){
            var idgrado = $("#sel_grado_estudiante").val();
            var idcurso = $("#sel_curso_estudiante").val();
            listar_curso_estudiante(idgrado);
            listar_persona_estudiante(idgrado,idcurso);
        })
        $("#sel_curso_estudiante").change(function(){
            var idgrado = $("#sel_grado_estudiante").val();
            var idcurso = $("#sel_curso_estudiante").val();
            listar_persona_estudiante(idgrado,idcurso);
        })
</script>
