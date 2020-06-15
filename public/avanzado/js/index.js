function listar_grado_profesor(){
    $.ajax({
        url: '../acad/asignacion/getgradopagina',
        type: 'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length){
            
            $.each(data, (indice, grado) => {
                cadena += `<option value="${grado.id}">${grado.nombre}</option>`;
            });
            
            $("#sel_grado_profesor").html(cadena);
            var idgrado = $("#sel_grado_profesor").val();
            listar_curso_profesor(idgrado);
            listar_asignatura_profesor(idgrado);
        }else{
            cadena +="<option value=''>'No Hay registros'</option>";
            $("#sel_grado_profesor").html(cadena);
        }
    })
}
function listar_curso_profesor(idgrado){
    $.ajax({
        url: '../acad/asignacion/getcursopagina',
        type: 'POST',
        data:{
            idgrado:idgrado
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length){
            $.each(data, (indice, curso) => {
                cadena += `<option value="${curso.id}">${curso.nombre}</option>`;
            });
            
            $("#sel_curso_profesor").html(cadena);
        }else{
            cadena +="<option value=''>'No Hay registros'</option>";
            $("#sel_curso_profesor").html(cadena);
        }
    })
}
function listar_asignatura_profesor(idgrado){
    $.ajax({
        url: '../acad/asignacion/getasignaturapagina',
        type: 'POST',
        data:{
            idgrado:idgrado
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length){
            $.each(data, (indice, asignatura) => {
                cadena += `<option value="${asignatura.id}">${asignatura.nombre}</option>`;
            });
            
            $("#sel_asignatura_profesor").html(cadena);
        }else{
            cadena +="<option value=''>'No Hay registros'</option>";
            $("#sel_asignatura_profesor").html(cadena);
        }
    })
}
function listar_grado_estudiante(){
    $.ajax({
        url: '../acad/asignacion/getgradopagina',
        type: 'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena=`<option value="0">Estudiante sin Matricular</option>`;
        if(data.length){
            
            $.each(data, (indice, grado) => {
                cadena += `<option value="${grado.id}">${grado.nombre}</option>`;
            });
            $("#sel_grado_estudiante").html(cadena);
            var idgrado = $("#sel_grado_estudiante").val();
            listar_curso_estudiante(idgrado);
        }else{
            cadena += `<option value="">No Hay registros</option>`;
            $("#sel_grado_estudiante").html(cadena);
        }
    })
}
function listar_curso_estudiante(idgrado){
    $.ajax({
        url: '../acad/asignacion/getcursopagina',
        type: 'POST',
        data:{
            idgrado:idgrado
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        var idgrado = $("#sel_grado_estudiante").val();
            if(idgrado==0){
                cadena += `<option value="0">Estudiante sin Matricula</option>`;
                $("#sel_curso_estudiante").html(cadena);
                var idcurso = $("#sel_curso_estudiante").val();
                listar_persona_estudiante(idgrado,idcurso);
            }else if(data.length){
                $.each(data, (indice, curso) => {
                    cadena += `<option value="${curso.id}">${curso.nombre}</option>`;
                });
                
                $("#sel_curso_estudiante").html(cadena);   
                var idcurso = $("#sel_curso_estudiante").val();
                var idgrado = $("#sel_grado_estudiante").val();
                listar_persona_estudiante(idgrado,idcurso);
            }else{
                cadena += `<option value="">No Hay registros</option>`;
                $("#sel_curso_estudiante").html(cadena);
            }
           
    })
}
function listar_persona_estudiante(idgrado,idcurso){
    $.ajax({
        url: '../acad/asignacion/getestudiantepagina',
        type: 'POST',
        data:{
            idgrado:idgrado,
            idcurso:idcurso
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length){
            $.each(data, (indice, estudiante) => {
                cadena += `<option value="${estudiante.id}">${estudiante.nombre} ${estudiante.apellido} ${estudiante.identificacion}</option>`;
            });
            $("#sel_persona_estudiante").html(cadena);
        }else{
            cadena += `<option value="">No Hay registros</option>`;
            $("#sel_persona_estudiante").html(cadena);
        }
    })
}
function listar_grado(){
    $.ajax({
        url: '../acad/asignacion/getgradopagina',
        type: 'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length){
            
            $.each(data, (indice, grado) => {
                cadena += `<option value="${grado.id}">${grado.nombre}</option>`;
            });
            
            $("#sel_grado").html(cadena);
            var idgrado = $("#sel_grado").val();
            listar_curso(idgrado);
        }else{
            cadena +="<option value=''>'No Hay registros'</option>";
            $("#sel_grado").html(cadena);
        }
    })
}
function listar_curso(idgrado){
    $.ajax({
        url: '../acad/asignacion/getcursopagina',
        type: 'POST',
        data:{
            idgrado:idgrado
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length){
            $.each(data, (indice, curso) => {
                cadena += `<option value="${curso.id}">${curso.nombre}</option>`;
            });
            
            $("#sel_curso").html(cadena);
        }else{
            cadena +="<option value=''>'No Hay registros'</option>";
            $("#sel_curso").html(cadena);
        }
    })
}