<?php
include_once 'libs/sesion.php';
class Salir extends Controller{

    public function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        $this->sesion->close();
        header('location: '.constant('URL').'main');
    }
    function render(){
        $this->view->render('salir/index');
    }

}

?>