<?php
include_once 'libs/sesion.php';
class distribucion extends Controller{

    function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }
        $this->view->mensaje="";
        $this->view->niveles = [];
        $this->view->grados = [];
        $this->view->cursos = [];
        $this->view->permisos=[];
    }
    function render(){
        $sesiones = $this->sesion->get('usuario');
        $permisos = $this->model->getpermiso($sesiones);
        $this->view->permisos = $permisos;
        $niveles = $this->model->getnivel();
        $this->view->niveles = $niveles;
        $grados = $this->model->getgrado();
        $this->view->grados = $grados;
        $cursos = $this->model->getcurso();
        $this->view->cursos = $cursos;
        $cursos_has_grados = $this->model->getcurso_has_grado();
        $this->view->cursos_has_grados = $cursos_has_grados;
        $this->view->render('distribucion/index');
    }

    function registrarNivel(){
        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $mensaje ="";
        if($this->model->insertnivel(['nombre' => $nombre,'estado' => $estado])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    function registrarGrado(){
        $nivel = $_POST['nivel'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $mensaje ="";
        if($this->model->insertgrado(['nombre' => $nombre,'nivel' => $nivel,'estado' => $estado])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    function registrarCurso(){
        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $mensaje ="";
        if($this->model->insertcurso(['nombre' => $nombre,'estado' => $estado])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    function asignarCurso(){
        $grado = $_POST['grado'];
        $curso = $_POST['curso'];
        $estado = $_POST['estado'];
        $mensaje ="";
        if($this->model->insertCurso_has_grado(['grado' => $grado,'curso' => $curso,'estado' => $estado])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
}


?>