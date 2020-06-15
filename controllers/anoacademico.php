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
        $anos_has_periodos = $this->model->getano_has_periodo();
        $this->view->anos_has_periodos = $anos_has_periodos;
        $this->view->render('anoacademico/index');
    }

    function registrarAno(){
        if(isset($_POST['crear'])){
            $nombre = $_POST['nombre'];
            $fechainicial = $_POST['fecha_inicial'];
            $fechafinal = $_POST['fecha_final'];
            $estado = $_POST['estado'];
            if($nombre==NULL | $fechainicial==NULL | $fechafinal==NULL | $estado==NULL){
                $this->view->mensaje = "Porfavor llene todos los campos1";
            }else if($this->model->insertano(['nombre' => $nombre,'fechainicial' => $fechainicial,'fechafinal' => $fechafinal,'estado' => $estado])){
                $this->view->mensaje = "Bien Hecho";
            }else{
                $this->view->mensaje ="Contacte con el proveedor";
            }    
        }else{
            $this->view->mensaje ="Porfavor utilice el formulario";
        }        
        $this->render();
    }
    function registrarPeriodo(){
        if(isset($_POST['crear'])){
            $nombre = $_POST['nombre'];
            $fechainicial = $_POST['fecha_inicial'];
            $fechafinal = $_POST['fecha_final'];
            $estado = $_POST['estado'];
            if(isset($_POST['grados'])){
                $activogrado = $_POST['grados'];
            }else{
                $activogrado = 0;
            }
            if(isset($_POST['profesor'])){
                $activoprofesor = $_POST['profesor'];
            }else{
                $activoprofesor = 0;
            }
            if($nombre==NULL | $fechainicial==NULL | $fechafinal==NULL | $estado==NULL){
                $this->view->mensaje = "Porfavor llene todos los campos";
            }else if($this->model->insertperiodo(['nombre' => $nombre,'fechainicial' => $fechainicial,'fechafinal' => $fechafinal,'estado' => $estado])){
                if($activogrado==1){
                    $i = $this->model->getultimoasignaturagrado();
                    $ano = $this->model->getanoperiodo();
                    $cantidadasignaturas = $this->model->gettotalasignaturas();
                    while($i>0){
                        if($cantidadasignaturas>0){
                            $grado = $this->model->getgrado($i);
                            $asignatura = $this->model->getasignatura($i);
                            if($this->model->insertgrado_has_asignatura($grado,$asignatura,$ano)){
                                $cantidadasignaturas--;
                                $i--;
                                $this->view->mensaje = "Grados Exitosos";
                            }
                        }else{
                            $i=0;
                        }
                    }
                }
                if($activoprofesor == 1){
                    $i = $this->model->getultimopersonacurso();
                    $ano = $this->model->getanoperiodo();
                    $cantidadasignaturas = $this->model->gettotalgradoasignaturas();
                    while($i>0){
                        if($cantidadasignaturas>0){
                            $grado = $this->model->getgrado2($i);
                            $asignatura = $this->model->getasignatura2($i);
                            $curso = $this->model->getcurso2($i);
                            $persona = $this->model->getpersona2($i);
                            $rotativo = $this->model->getrotativo2($i);
                            if($this->model->insertpersona_has_asignatura_has_curso($grado,$asignatura,$ano,$curso,$persona,$rotativo)){
                                $cantidadasignaturas--;
                                $i--;
                                $this->view->mensaje = "Grados Exitosos";
                            }
                        }else{
                            $i=0;
                        }
                    }
                }
                $this->view->mensaje = "Bien Hecho";
            }else{
                $this->view->mensaje ="Contacte con el proveedor";
            }    
        }else{
            $this->view->mensaje ="Porfavor utilice el formulario";
        }        
        $this->render();        
    }
    
}


?>