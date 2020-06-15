<?php
include_once 'libs/sesion.php';
class asignacion extends Controller{

    function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }
        $personas = [];
        $this->view->mensaje="";
    }
    function render(){
        $personas = $this->model->getpersonad();
        $this->view->personas = $personas;
        $this->view->render('asignacion/index');
    }

    function getgradopagina(){
        $grados = $this->model->getgrado();
        echo json_encode($grados);
    }
    function getcursopagina(){
        $idgrado = $_POST['idgrado'];
        $cursos = $this->model->getcurso($idgrado);
        echo json_encode($cursos);
    }
    function getasignaturapagina(){
        $idgrado = $_POST['idgrado'];
        $asignaturas = $this->model->getasignatura($idgrado);
        echo json_encode($asignaturas);
    }
    function getpersonapagina(){
        $personas = $this->model->getpersona();
        echo json_encode($personas);
    }
    function getestudiantepagina(){
        $idgrado=$_POST['idgrado'];
        $idcurso=$_POST['idcurso'];
        
        if($idcurso==0){
            $estudiante = $this->model->getestudiantesinmatricula();
            echo json_encode($estudiante);
        }else{
            $estudiante = $this->model->getestudianteconmatricula($idgrado,$idcurso);
            echo json_encode($estudiante);
        }
    }
    function asignarPersona(){
        if(isset($_POST['asignar'])){
            $grado = $_POST['grado'];
            $curso = $_POST['curso'];
            $persona = $_POST['persona'];
            $asignatura = $_POST['asignatura'];
            if(isset($_POST['rotativo'])){
                $rotativo = $_POST['rotativo'];
            }else{
                $rotativo = 0;
            }
            $periodo = $this->model->getperiodo();
            if($this->model->insertpersonahasasignatura(['grado' => $grado,'curso' => $curso,'persona' => $persona,'asignatura' => $asignatura,'rotativo' => $rotativo,'periodo' => $periodo])){
                header('location: '.constant('URL').'asignacion');
                $this->view->mensaje = "Bien Hecho";
            }else{
                $this->view->mensaje = "Fallo";
            }
        }else{
            $this->view->mensaje = "Utilice el Formulario";
        }
        $this->render();
    }
    function matricularEstudiante(){
        if(isset($_POST['asignar'])){
            $grado = $_POST['grado'];
            $curso = $_POST['curso'];
            $persona = $_POST['persona'];
            $gradoantes = $_POST['gradoantes'];
            if(isset($_POST['graduar'])){
                $graduar = $_POST['graduar'];
            }else{
                $graduar = 0;
            }
            if($graduar==1){
                if($this->model->getgradoultimopeso()==$this->model->getgradopeso($gradoantes)){
                    if($this->model->updatematricula($this->model->getidpersonamatricula($persona),2)){
                        header('location: '.constant('URL').'asignacion');
                        echo "Bien";
                    }else{
                        echo "Fallo1";
                    }
                }
            }else{
                $peso1 = $this->model->getgradopeso($grado);
                $peso2 = $this->model->getgradopeso($gradoantes);
                $cursoantes = $_POST['cursoantes'];
                $fecha = date("Y-m-d");
                $ano = $this->model->getano();
                if($peso1>$peso2){
                    if($this->model->updatematricula($this->model->getidpersonamatricula($persona),2)){
                        echo "Bien";
                    }else{
                        echo "Fallo1";
                    }
                }else{
                    if($this->model->updatematricula($this->model->getidpersonamatricula($persona),3)){
                        echo "Bien";
                    }else{
                        echo "Fallo2";
                    }
                }
                if($this->model->insertmatriculaestudiante(['grado' => $grado,'curso' => $curso,'persona' => $persona,'fecha' => $fecha,'ano' => $ano])){
                    header('location: '.constant('URL').'asignacion');
                    $mensaje = "Bien Hecho";
                }else{
                    $this->view->mensaje = "Fallo";
                }
            }
        }else{
            $this->view->mensaje = "Utilice el Formulario";
        }
        $this->render();
    }
}

?>