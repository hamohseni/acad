<?php

include_once 'libs/sesion.php';
class Perfil extends Controller{

    private $sesion;
    public function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }
        $this->view->mensaje="";    
        $this->view->permisos = []; 
        
    }
    public function render(){
        $sesiones = $this->sesion->get('usuario');
        $permisos = $this->model->getpermiso($sesiones);
        $this->view->permisos = $permisos;
        $personas = $this->model->getdatospersonales($sesiones);
        $this->view->personas = $personas;
        $this->view->render('perfil/index');
    }



}

?>