<?php

class cargosModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public function insertcargo($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Cargo (car_nombre) VALUES (:cargo)');
            $query->execute(['cargo' => $datos['cargo']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        } 
    }


}


?>