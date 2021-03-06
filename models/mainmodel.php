<?php

include_once 'entidades/persona.php';

class mainModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public function existeusuario($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM Persona WHERE per_identificacion=:usuario");
            $query->execute(['usuario' => $datos['usuario']]);
            return $query->fetchColumn();
        }catch(PDOException $e){
            return false;
        }
    }
    public function comprobardatos($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM Persona WHERE per_identificacion=:usuario AND per_contrasena=:contrasena");
            $query->execute(['usuario' => $datos['usuario'],'contrasena' => $datos['contrasena']]);
            return $query->fetchColumn();
        }catch(PDOException $e){
            echo 'no se pudo';
            return false;
        }
    }




}

?>