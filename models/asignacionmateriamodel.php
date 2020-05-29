<?php
//hola
include_once 'entidades/grado.php';
include_once 'entidades/asignatura.php';
include_once 'entidades/grado_has_asignatura.php';

class asignacionmateriaModel extends Model{

    public function __construct(){
        parent:: __construct();
        
    }

    public function insertGrado_has_Asignatura($datos){
        try{
            $query1 = $this->db->connect()->query('SELECT ano_per_id  FROM Ano_has_Periodo NATURAL JOIN ano ORDER BY ano_id DESC LIMIT 1');
            $row = $query1->fetch(); 
            $query = $this->db->connect()->prepare('INSERT INTO Grado_has_Asignatura (gra_id,asi_id,ano_per_id) VALUES (:grado,:asignatura,'.$row['ano_per_id'].')');
            $query->execute(['grado' => $datos['grado'],'asignatura' => $datos['asignatura']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   

    public function getgrado(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Grado");

            while($row = $query->fetch()){
                $item = new Grado();
                $item->id = $row['gra_id'];
                $item->nombre = $row['gra_nombre'];
                $item->nivel = $row['niv_id'];
                $item->estado = $row['gra_estado'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getasignatura(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Asignatura");

            while($row = $query->fetch()){
                $item = new Asignatura();
                $item->id = $row['asi_id'];
                $item->nombre = $row['asi_nombre'];
                $item->materia = $row['mat_id'];
                $item->rotativo = $row['asi_rotativo'];
                $item->estado = $row['asi_estado'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getgrado_has_asignatura(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Grado_has_Asignatura NATURAL JOIN Asignatura");

            while($row = $query->fetch()){
                $item = new Grado_has_Asignatura();
                $item->id = $row['gra_asi_id'];
                $item->grado = $row['gra_id'];
                $item->asignatura = $row['asi_id'];
                $item->nombre = $row['asi_nombre'];
                $item->estado = $row['asi_estado'];
                
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

}

?>