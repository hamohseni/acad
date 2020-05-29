<?php
//hola
class asignacionmateria extends Controller{

    function __construct(){
        parent:: __construct();
        $this->view->mensaje="";
        $this->view->asignaturas = [];
        $this->view->grados = [];
        $this->view->grados_has_asignaturas = [];
    }
    function render(){
        $grados = $this->model->getgrado();
        $this->view->grados = $grados;
        $asignaturas = $this->model->getasignatura();
        $this->view->asignaturas = $asignaturas;
        $grados_has_asignaturas = $this->model->getGrado_has_Asignatura();
        $this->view->grados_has_asignaturas = $grados_has_asignaturas;
        $this->view->render('asignacionmateria/index');
    }

    function asignarGradoAsignatura(){
        $grado = $_POST['grado'];
        $asignatura = $_POST['asignatura'];
        $mensaje ="";
        if($this->model->insertGrado_has_Asignatura(['grado' => $grado,'asignatura' => $asignatura])){
            $mensaje = "Bien Hecho";
        }else{
            $mensaje ="F";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }
    
}


?>