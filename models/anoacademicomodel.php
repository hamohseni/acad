<?php

include_once 'entidades/ano.php';
include_once 'entidades/periodo.php';
include_once 'entidades/ano_has_periodo.php';

class anoacademicoModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public function insertano($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Ano (ano_nombre) VALUES (:nombre)');
            $query->execute(['nombre' => $datos['nombre']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }  
    public function insertperiodo($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Periodo (per_nombre) VALUES (:nombre)');
            $query->execute(['nombre' => $datos['nombre']]);
            $query1 = $this->db->connect()->query('SELECT COUNT(ano_per_id) AS result FROM Grado_has_Asignatura WHERE ano_per_id = (SELECT ano_per_id FROM Grado_has_Asignatura ORDER BY ano_per_id DESC LIMIT 1)');
            $row = $query1->fetch();
            $call = $row['result'];
            for($i=$call;$i>=0;$i--){
                $query = $this->db->connect()->query('INSERT INTO Grado_has_Asignatura (gra_id,asi_id,ano_per_id) SELECT gra_id,asi_id,3 FROM Grado_has_Asignatura WHERE gra_asi_id =(SELECT gra_asi_id-'.$i.' FROM Grado_has_Asignatura ORDER BY ano_per_id DESC LIMIT 1)');
            } 

            
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }     

    public function getano(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Ano");

            while($row = $query->fetch()){
                $item = new Ano();
                $item->id = $row['ano_id'];
                $item->nombre = $row['ano_nombre'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getperiodo(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Periodo");

            while($row = $query->fetch()){
                $item = new Periodo();
                $item->id = $row['per_id'];
                $item->nombre = $row['per_nombre'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getano_has_periodo(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Ano_has_Periodo NATURAL JOIN Periodo");

            while($row = $query->fetch()){
                $item = new Ano_has_Periodo();
                $item->id = $row['ano_per_id'];
                $item->ano = $row['ano_id'];
                $item->periodo = $row['per_id'];
                $item->nombre = $row['per_nombre'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getpermiso($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=2");
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