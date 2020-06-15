<?php
include_once 'libs/sesion.php';
class asignacionmateria extends Controller{

    function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }
        $this->view->mensaje="";
        $this->view->asignaturas = [];
        $this->view->grados = [];
        $this->view->grados_has_asignaturas = [];
        $this->view->permisos = [];
    }
    function render(){
        $sesiones = $this->sesion->get('usuario');
        $permisos = $this->model->getpermiso($sesiones);
        $this->view->permisos = $permisos;
        $grados = $this->model->getgrado();
        $this->view->grados = $grados;
        $asignaturas = $this->model->getasignatura();
        $this->view->asignaturas = $asignaturas;
        $grados_has_asignaturas = $this->model->getGrado_has_Asignatura();
        $this->view->grados_has_asignaturas = $grados_has_asignaturas;
        $this->view->render('asignacionmateria/index');
    }

    function asignarGradoAsignatura(){
        if(isset($_POST['crear'])){
            $grado = $_POST['grado'];
            $asignatura = $_POST['asignatura'];
            $mensaje ="";
            if($this->model->insertGrado_has_Asignatura(['grado' => $grado,'asignatura' => $asignatura])){
                $mensaje = "Bien Hecho";
            }else{
                $mensaje ="F";
            }
        }else{
            $mensaje ="Por favor utilice el formulario";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    
}


?>