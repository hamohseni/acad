<?php
include_once 'libs/sesion.php';
class anoacademico extends Controller{

    function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }
        $this->view->mensaje="";
        $this->view->anos = [];
        $this->view->periodos = [];
        $this->view->anos_has_periodos = [];
        $this->view->permisos = [];
    }
    function render(){
        $sesiones = $this->sesion->get('usuario');
        $permisos = $this->model->getpermiso($sesiones);
        $this->view->permisos = $permisos;
        $anos = $this->model->getano();
        $this->view->anos = $anos;
        $periodos = $this->model->getperiodo();
        $this->view->periodos = $periodos;
        $anos_has_periodos = $this->model->getano_has_periodo();
        $this->view->anos_has_periodos = $anos_has_periodos;
        $this->view->render('anoacademico/index');
    }

    function registrarAno(){
        $nombre = $_POST['nombre'];
        $mensaje ="";
        if($this->model->insertano(['nombre' => $nombre])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    function registrarPeriodo(){
        $nombre = $_POST['nombre'];
        $mensaje ="";
        if($this->model->insertperiodo(['nombre' => $nombre])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    
}


?>