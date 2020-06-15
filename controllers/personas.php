<?php

include_once 'libs/sesion.php';
class Personas extends Controller{

    private $sesion;
    public function __construct(){
        parent:: __construct();
        $this->sesion = new Sesion();
        $this->sesion->init();
        if($this->sesion->getStatus()=== 1 || empty($this->sesion->get('usuario'))){
            exit('Acceso denegado');
        }

        $this->view->mensaje="";    
        $this->view->cargos = []; 
        $this->view->permisos = []; 
        
    }
    public function render(){
        $sesiones = $this->sesion->get('usuario');
        $permisos = $this->model->getpermiso($sesiones);
        $this->view->permisos = $permisos;
        $cargos = $this->model->getcargo();
        $this->view->cargos = $cargos;
        $this->view->render('personas/index');
    }

    function registrarPersona(){
        if(isset($_POST['crear'])){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $identificacion = $_POST['identificacion'];
            $telefono = $_POST['telefono'];
            $celular = $_POST['celular'];
            $correo = $_POST['correo'];
            $codigo = $_POST['codigo'];
            $direccion = $_POST['direccion'];
            $pais = $_POST['pais'];
            $ciudad = $_POST['ciudad'];
            $nacimiento = $_POST['nacimiento'];
            $ingreso = date("Y-m-d");
            $contrasenaencrip = $_POST['contrasena'];
            $contrasena = md5($contrasenaencrip);
            $cargo = $_POST['cargo'];
            $tipodocumento = $_POST['tipodocumento'];
            if($cargo == 1 | $cargo == 2){
                $estado = 0;
            }else{
                $estado = 1;
            }
            $mensaje ="";
            $uploadedfileload="true";
            $uploadedfile_size=$_FILES['uploadedfile']['size'];
            if ($_FILES['uploadedfile']['size']>5242880){
                $mensaje="La a foto es demasiado pesada y no se subió al servidor, el peso máximo son 5MB, para resubirla selecciona el producto creado y haz clic en editar.";
                $uploadedfileload="false";
            }
            if (!($_FILES['uploadedfile']['type'] =="image/jpeg" OR $_FILES['uploadedfile']['type'] =="image/gif" OR $_FILES['uploadedfile']['type'] =="image/png")){
                $mensaje="No se selecccionó ninguna foto o ésta tiene un formato no válido y no se subió al servidor, debe ser .jpg .png o .gif, para resubirla selecciona el producto creado y haz clic en editar.";
                $uploadedfileload="false";
            }
            $file_name=$_FILES['uploadedfile']['name'];
            $add="public/imgs/perfil/$identificacion/$file_name";
            $nombreimagen="$file_name";
            
            if($nombre==NULL | $apellido==NULL | $identificacion==NULL| $telefono==NULL | $correo==NULL | $codigo==NULL | $direccion==NULL | $pais==NULL | $ciudad==NULL | $nacimiento==NULL | $ingreso==NULL | $contrasenaencrip==NULL | $tipodocumento==NULL){
                $mensaje = "Es necesario que se llene todos los campos";
            }else{
                if($this->model->insertpersona(['nombre' => $nombre,'apellido' => $apellido,'identificacion' => $identificacion,'telefono' => $telefono,'celular' => $celular,'correo' => $correo,'codigo' => $codigo,'direccion' => $direccion,'pais' => $pais,'ciudad' => $ciudad,'nacimiento' => $nacimiento,'ingreso' => $ingreso,'contrasena' => $contrasena,'imagen' => $nombreimagen,'tipodocumento' => $tipodocumento,'estado' => $estado])){
                    if($uploadedfileload=="true"){
                        $crear3=mkdir("public/imgs/perfil/".$_POST["identificacion"]."", 0755);
                        if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $add)){
                        //Nada XD
                        }else{
                            echo "<p><b><font color='red'>Error al subir la foto, inténtelo más tarde nuevamente. <small>Posiblemente el servidor no se encontraba listo o se debe a un error de permisos chmod de los directorios. Si el problema persiste contacte al programador. Si usted no es el administrador por favor muéstrele este mensaje de error.</small></font></b></p>";
                        }
                    }
                    if($uploadedfileload=="false"){
                        $nombreimagen="";
                    } 
                    
                    if($this->model->insertpersonahascargo(['cargo'=> $cargo,'identificacion'=> $identificacion])){
                        $mensaje = "Se creó correctamente";
                    }               
                }else{
                    $mensaje ="Hubo un error, intentelo nuevamente.";
                }
            }
        }else{
            exit('Utilice el Formulario');
        }
        
        $this->view->mensaje = $mensaje;
        $this->render();
        
    }


}

?>