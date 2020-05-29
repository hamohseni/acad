<?php
class Controller{

    private $sesion;

    function __construct(){

        //echo "<p>Controlador Base</p>";
        $this->view = new View();
        $this->model = new Model();
    }

    function loadModel($model){

        $url = 'models/'.$model.'model.php';

        if(file_exists($url)){
            require $url;

            $modelName = $model.'Model';
            $this->model = new $modelName();
        }

    }

}

?>