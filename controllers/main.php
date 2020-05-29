<?php
//hola

include_once 'libs/sesion.php';
class Main extends Controller{

    private $sesion;

    function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
    }
    function render(){
        $this->view->render('main/index');
    }

    function ingresar(){

        $_SESSION["ultimoacceso"] = date("d-m-Y H:i:s");
        $usuario = strip_tags(substr($_POST['usuario'],0,32));
        $tomarcontrasena = strip_tags(substr($_POST['contrasena'],0,32));
        $contrasena = md5($tomarcontrasena);
        $fecha = date("d-m-Y H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];
        if($this->model->existeusuario(['usuario' => $usuario]) <= 0){
            echo 'El nombre de usuario que colocaste no existe, verificalo por favor';
        }else if($this->model->comprobardatos(['usuario' => $usuario,'contrasena' => $contrasena]) <= 0) {
            echo 'La contrase&ntilde;a es incorrecta! Verif&iacute;cala e int&eacute;ntalo de nuevo.';
        }else{
            $result = $this->model->asignarsesion(['usuario' => $usuario]);
            $this->sesion->init();
            $this->sesion->add('usuario',$result);
            header('location: '.constant('URL').'vermateria');
        }
    }
}



?>