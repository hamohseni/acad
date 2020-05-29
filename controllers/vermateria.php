<?php
include_once 'libs/sesion.php';
class verMateria extends Controller{

    function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }
        $this->view->mensaje="";
        $this->view->materias = [];
        $this->view->asignaturas = [];
        $this->view->permisos = [];
        
    }
    function render(){
        $sesiones = $this->sesion->get('usuario');
        $permisos = $this->model->getpermiso($sesiones);
        $this->view->permisos = $permisos;
        $materias = $this->model->getmateria();
        $this->view->materias = $materias;
        $asignaturas = $this->model->getasignatura();
        $this->view->asignaturas = $asignaturas;
        $this->view->render('vermateria/index');
    }

    function registrarMateria(){
        $nombre = $_POST['nombre'];
        $mensaje ="";
        if($this->model->insertmateria(['nombre' => $nombre])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    function registrarAsignatura(){
        $materia = $_POST['materia'];
        $nombre = $_POST['nombre'];
        $rotativo = $_POST['rotativo'];
        $mensaje ="";
        if($this->model->insertasignatura(['nombre' => $nombre,'materia' => $materia,'rotativo' => $rotativo])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }

}


?>