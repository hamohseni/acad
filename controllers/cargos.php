<?php

include_once 'libs/sesion.php';
class Cargos extends Controller{

    private $sesion;
    public function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }
        $this->view->mensaje="";        
    }
    public function render(){
        
        $this->view->render('cargos/index');
    }

    function registrarCargo(){
        $cargo = $_POST['cargo'];
        $mensaje ="";
        if($cargo==NULL){
            $mensaje = "Es necesario que llene el nombre del cargo a crear";
        }else{
            if($this->model->insertcargo(['cargo' => $cargo])){
                $mensaje = "Se creó correctamente";
            }else{
                $mensaje ="Hubo un error, intentelo nuevamente.";
            }
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }


}

?>