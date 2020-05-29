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
    public function getpermiso($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=4");
            $query->execute(['identificacion' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_perm_estado;
            return $result;
            echo $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }


}


?>