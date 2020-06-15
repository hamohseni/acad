<?php

include_once 'libs/sesion.php';
class Main extends Controller{

    private $sesion;

    function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->view->mensaje="";
        $this->sesion->init();
        if(($this->sesion->get('usuario'))){
            header('location: '.constant('URL').'perfil');
        }
    }
    function render(){
        $this->view->render('main/index');            
    }

    function ingresar(){
        $mensaje ='';
        $_SESSION["ultimoacceso"] = date("d-m-Y H:i:s");
        if(isset($_POST['ingresar'])){
            if($_POST['usuario']==NULL | $_POST['contrasena']==NULL){
                $mensaje = 
                '
                <div class="col-md-6 mx-auto alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <font color="#338AFF"><p align="center"><b>&#161;Debes escribir tu nombre usuario y contrase&ntilde;a para poder ingresar&#33;</b></p></font>
                </div>
                ';
            }else{
                $usuario = strip_tags(substr($_POST['usuario'],0,32));
                $tomarcontrasena = strip_tags(substr($_POST['contrasena'],0,32));
                $contrasena = md5($tomarcontrasena);
                $fecha = date("d-m-Y H:i:s");
                $ip = $_SERVER['REMOTE_ADDR'];
                if($this->model->existeusuario(['usuario' => $usuario]) <= 0){
                    $mensaje = 
                    '
                    <div class="col-md-6 mx-auto alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <font color="#338AFF"><p align="center"><b>El nombre de usuario que colocaste no existe, verif&iacute;calo por favor.</b></p></font>
                    </div>
                    ';
                }else if($this->model->comprobardatos(['usuario' => $usuario,'contrasena' => $contrasena]) <= 0) {
                    $mensaje = 
                    '
                    <div class="col-md-6 mx-auto alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <font color="#338AFF"><p align="center" ><b>&#161;La contrase&ntilde;a es incorrecta! Verif&iacute;cala e int&eacute;ntalo de nuevo.</b></p></font>
                    </div>
                    ';
                }else{
                    $this->sesion->init();
                    $this->sesion->add('usuario',$usuario);
                    header('location: '.constant('URL').'perfil');
                }
            }
        }else{
            header('location: '.constant('URL').'main');
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }
}



?>