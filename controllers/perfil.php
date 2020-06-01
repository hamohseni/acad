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
        $permisos = $this->model->getpermisopaginaperfil($sesiones);
        $this->view->permisos = $permisos;
        $personas = $this->model->getdatospersonales($sesiones);
        $this->view->personas = $personas;
        $this->view->render('perfil/index');
    }
    public function editarinformacionpersonal(){
        $sesiones = $this->sesion->get('usuario');
        $persona = $this->model->getdatos($sesiones);
        $this->view->persona = $persona;
        $permisos = $this->model->getpermisopaginacambiarinformacion($sesiones);
        $this->view->permisos = $permisos;
        $permisonombre = $this->model->getpermisocambiardatos($sesiones,11);
        $this->view->permisonombre = $permisonombre;
        $permisoapellido = $this->model->getpermisocambiardatos($sesiones,12);
        $this->view->permisoapellido = $permisoapellido;
        $permisoimagen = $this->model->getpermisocambiardatos($sesiones,13);
        $this->view->permisoimagen = $permisoimagen;
        $permisoidentificacion = $this->model->getpermisocambiardatos($sesiones,14);
        $this->view->permisoidentificacion = $permisoidentificacion;
        $permisotelefono = $this->model->getpermisocambiardatos($sesiones,15);
        $this->view->permisotelefono = $permisotelefono;
        $permisocelular = $this->model->getpermisocambiardatos($sesiones,16);
        $this->view->permisocelular = $permisocelular;
        $permisocorreo = $this->model->getpermisocambiardatos($sesiones,17);
        $this->view->permisocorreo = $permisocorreo;
        $permisodireccion = $this->model->getpermisocambiardatos($sesiones,18);
        $this->view->permisodireccion = $permisodireccion;
        $permisopais = $this->model->getpermisocambiardatos($sesiones,19);
        $this->view->permisopais = $permisopais;
        $permisociudad = $this->model->getpermisocambiardatos($sesiones,20);
        $this->view->permisociudad = $permisociudad;
        $permisonacimiento = $this->model->getpermisocambiardatos($sesiones,21);
        $this->view->permisonacimiento = $permisonacimiento;
        $permisotipodocumento = $this->model->getpermisocambiardatos($sesiones,22);
        $this->view->permisotipodocumento = $permisotipodocumento;
        $permisoactualizar = $this->model->getpermisocambiardatos($sesiones,23);
        $this->view->permisoactualizar = $permisoactualizar;
        $this->view->render('perfil/cambiarinformacionpersonal');
    }
    public function editarcontrasena(){
        $sesiones = $this->sesion->get('usuario');
        $permisos = $this->model->getpermisopaginacambiarcontrasena($sesiones);
        $this->view->permisos = $permisos;
        $this->view->render('perfil/cambiarcontrasena');
    }
    public function actualizarInformacionPersonal(){
        $sesiones = $this->sesion->get('usuario');
        $permisonombre = $this->model->getpermisocambiardatos($sesiones,11);
        $this->view->permisonombre = $permisonombre;
        $permisoapellido = $this->model->getpermisocambiardatos($sesiones,12);
        $this->view->permisoapellido = $permisoapellido;
        $permisoimagen = $this->model->getpermisocambiardatos($sesiones,13);
        $this->view->permisoimagen = $permisoimagen;
        $permisoidentificacion = $this->model->getpermisocambiardatos($sesiones,14);
        $this->view->permisoidentificacion = $permisoidentificacion;
        $permisotelefono = $this->model->getpermisocambiardatos($sesiones,15);
        $this->view->permisotelefono = $permisotelefono;
        $permisocelular = $this->model->getpermisocambiardatos($sesiones,16);
        $this->view->permisocelular = $permisocelular;
        $permisocorreo = $this->model->getpermisocambiardatos($sesiones,17);
        $this->view->permisocorreo = $permisocorreo;
        $permisodireccion = $this->model->getpermisocambiardatos($sesiones,18);
        $this->view->permisodireccion = $permisodireccion;
        $permisopais = $this->model->getpermisocambiardatos($sesiones,19);
        $this->view->permisopais = $permisopais;
        $permisociudad = $this->model->getpermisocambiardatos($sesiones,20);
        $this->view->permisociudad = $permisociudad;
        $permisonacimiento = $this->model->getpermisocambiardatos($sesiones,21);
        $this->view->permisonacimiento = $permisonacimiento;
        $permisotipodocumento = $this->model->getpermisocambiardatos($sesiones,22);
        $this->view->permisotipodocumento = $permisotipodocumento;
        $permisoactualizar = $this->model->getpermisocambiardatos($sesiones,23);
        $this->view->permisoactualizar = $permisoactualizar;
        $identificacion = $this->sesion->get('usuario');
        if($this->model->getpermisocambiardatos($sesiones,23)==0){
            exit("No se puede realizar esta accion.");
        }else{
            if(isset($_POST['nombre']) ){
                $nombre = $_POST['nombre'];
            }else{
                $nombre = $this->model->getdatosunico($sesiones,'per_nombre');
            }
            if(isset($_POST['apellido']) ){
                $apellido = $_POST['apellido'];
            }else{
                $apellido = $this->model->getdatosunico($sesiones,'per_apellido');
            }
            if(isset($_POST['identificacionnueva']) ){
                $identificacionnueva = $_POST['identificacionnueva'];
            }else{
                $identificacionnueva = $this->model->getdatosunico($sesiones,'per_identificacion');
            }
            if(isset($_POST['telefono']) ){
                $telefono = $_POST['telefono'];
            }else{
                $telefono = $this->model->getdatosunico($sesiones,'per_telefono');
            }
            if(isset($_POST['celular']) ){
                $celular = $_POST['celular'];
            }else{
                $celular = $this->model->getdatosunico($sesiones,'per_celular');
            }
            if(isset($_POST['direccion']) ){
                $direccion = $_POST['direccion'];
            }else{
                $direccion = $this->model->getdatosunico($sesiones,'per_direccion');
            }
            if(isset($_POST['correo']) ){
                $correo = $_POST['correo'];
            }else{
                $correo = $this->model->getdatosunico($sesiones,'per_correo');
            }
            if(isset($_POST['pais']) ){
                $pais = $_POST['pais'];
            }else{
                $pais = $this->model->getdatosunico($sesiones,'per_pais');
            }
            if(isset($_POST['ciudad']) ){
                $ciudad = $_POST['ciudad'];
            }else{
                $ciudad = $this->model->getdatosunico($sesiones,'per_ciudad');
            }
            if(isset($_POST['nacimiento']) ){
                $nacimiento = $_POST['nacimiento'];
            }else{
                $nacimiento = $this->model->getdatosunico($sesiones,'per_nacimiento');
            }
            if(isset($_POST['tipodocumento']) ){
                $tipodocumento = $_POST['tipodocumento'];
            }else{
                $tipodocumento = $this->model->getdatosunico($sesiones,'per_tipo_documento');
            }
            if(($this->model->getpermisocambiardatos($sesiones,13))==1){
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
                $add="public/imgs/perfil/$identificacionnueva/$file_name";
                $nombreimagen="$file_name";
            }
            
            if($nombre==NULL | $apellido==NULL | $telefono==NULL | $celular==NULL | $direccion==NULL | $correo==NULL | $pais==NULL | $ciudad==NULL | $nacimiento== NULL | $identificacionnueva==NULL | $tipodocumento==NULL){
                $this->view->mensaje = "Todos los campos no estan completos";
                $persona = new Persona();
                $persona->nombre = $nombre;
                $persona->apellido = $apellido;
                $persona->identificacion = $identificacionnueva;
                $persona->pais = $pais;
                $persona->ciudad = $ciudad;
                $persona->nacimiento = $nacimiento;
                $persona->telefono = $telefono;
                $persona->direccion = $direccion;
                $persona->celular = $celular;
                $persona->correo = $correo;
                $persona->tipodocumento = $tipodocumento;
                $this->view->persona = $persona;
            }elseif($this->model->actualizarinformacion(['nombre' => $nombre,'apellido' => $apellido,'identificacionnueva' => $identificacionnueva,'pais' => $pais,'ciudad' => $ciudad,'nacimiento' => $nacimiento,'tipodocumento' => $tipodocumento,'telefono' => $telefono,'celular'=>$celular,'direccion'=>$direccion,'correo'=>$correo,'identificacion'=>$identificacion])){
                $guardar = rename("public/imgs/perfil/".$identificacion."", "public/imgs/perfil/".$identificacionnueva."");
                    if(($this->model->getpermisocambiardatos($identificacionnueva,13))==1){
                        if($uploadedfileload=="true"){
                            if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $add)){
                            //Nada XD
                            }else{
                                echo "<p><b><font color='red'>Error al subir la foto, inténtelo más tarde nuevamente. <small>Posiblemente el servidor no se encontraba listo o se debe a un error de permisos chmod de los directorios. Si el problema persiste contacte al programador. Si usted no es el administrador por favor muéstrele este mensaje de error.</small></font></b></p>";
                            }
                            if($this->model->actualizarinformacionimagen(['imagen' => $nombreimagen,'identificacion' => $identificacionnueva])){

                            }
                        }
                        if($uploadedfileload=="false"){
                            $nombreimagen="";
                        }
                    }
                $this->sesion->remove('usuario');
                $this->sesion->close();
                $this->sesion->init();
                $this->sesion->add('usuario',$identificacionnueva);
                $persona = new Persona();
                $persona->nombre = $nombre;
                $persona->apellido = $apellido;
                $persona->identificacion = $identificacionnueva;
                $persona->pais = $pais;
                $persona->ciudad = $ciudad;
                $persona->nacimiento = $nacimiento;
                $persona->telefono = $telefono;
                $persona->direccion = $direccion;
                $persona->celular = $celular;
                $persona->correo = $correo;
                $persona->tipodocumento = $tipodocumento;
                $this->view->persona = $persona;
                $this->view->mensaje = "Alumno actualizado correctamente";
            }else{
                $this->view->mensaje = "No se pudo actualizar al alumno";
            }
            $this->view->render('perfil/cambiarinformacionpersonal');
        }
    }
    public function actualizarcontrasena(){
        $identificacion = $this->sesion->get('usuario');
        $contrasenaactual  = $_POST['contrasenaactual'];
        $contrasenaactualencrip = md5($contrasenaactual);
        $contrasenanueva = $_POST['contrasenanueva'];
        $contrasenanuevaconfirmado = $_POST['confirmarcontrasenanueva'];
        $contrasenanuevaencrip = md5($contrasenanueva);
        if($contrasenaactual==NULL | $contrasenanueva==NULL | $contrasenanuevaconfirmado==NULL ){
            $this->view->mensaje = "Ingrese los datos en los campos";
        }elseif(($this->model->getcontrasena(['identificacion' => $identificacion])) != $contrasenaactualencrip){
            $this->view->mensaje = "La contraseña que ingresó no coincide con el que está en el sistema";
        }elseif($contrasenanueva != $contrasenanuevaconfirmado){
            $this->view->mensaje = "Las contraseñas que ingresó no coinciden";
        }else{
            if($this->model->actualizarinformacioncontrasena(['contrasena'=> $contrasenanuevaencrip,'identificacion'=> $identificacion])){
                $this->view->mensaje = "Contraseña actualizado correctamente";
            }
        } 
        $this->view->render('perfil/cambiarcontrasena');
    }
}

?>