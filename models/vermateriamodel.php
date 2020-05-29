<?php

include_once 'entidades/materia.php';
include_once 'entidades/asignatura.php';

class vermateriaModel extends Model{

    public function __construct(){
        parent:: __construct();
        
    }

    public function insertmateria($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO materia (mat_nombre) VALUES (:nombre)');
            $query->execute(['nombre' => $datos['nombre']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }  
    public function insertasignatura($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO asignatura (mat_id,asi_nombre,asi_rotativo) VALUES (:materia,:nombre,:rotativo)');
            $query->execute(['materia' => $datos['materia'],'nombre' => $datos['nombre'],'rotativo' => $datos['rotativo']]);

            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   

    public function getmateria(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM materia");

            while($row = $query->fetch()){
                $item = new Materia();
                $item->id = $row['mat_id'];
                $item->nombre    = $row['mat_nombre'];

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

            $query = $this->db->connect()->query("SELECT * FROM asignatura");

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

}

?>