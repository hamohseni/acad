<?php

include_once 'entidades/nivel.php';
include_once 'entidades/grado.php';
include_once 'entidades/curso.php';
include_once 'entidades/curso_has_grado.php';

class distribucionModel extends Model{

    public function __construct(){
        parent:: __construct();
        
    }

    public function insertNivel($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Nivel (niv_nombre,niv_estado) VALUES (:nombre,:estado)');
            $query->execute(['nombre' => $datos['nombre'],'estado' => $datos['estado']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }  
    public function insertGrado($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Grado (gra_nombre,niv_id,gra_estado) VALUES (:nombre,:nivel,:estado)');
            $query->execute(['nombre' => $datos['nombre'],'nivel' => $datos['nivel'],'estado' => $datos['estado']]);

            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   
    public function insertCurso($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Curso (cur_nombre,cur_estado) VALUES (:nombre,:estado)');
            $query->execute(['nombre' => $datos['nombre'],'estado' => $datos['estado']]);

            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   
    public function insertCurso_has_Grado($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Curso_has_Grado (cur_id,gra_id,cur_gra_estado) VALUES (:curso,:grado,:estado)');
            $query->execute(['curso' => $datos['curso'],'grado' => $datos['grado'],'estado' => $datos['estado']]);

            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   

    public function getnivel(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Nivel");

            while($row = $query->fetch()){
                $item = new Nivel();
                $item->id = $row['niv_id'];
                $item->nombre    = $row['niv_nombre'];
                $item->estado = $row['niv_estado'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
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
    public function getcurso(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Curso");

            while($row = $query->fetch()){
                $item = new Curso();
                $item->id = $row['cur_id'];
                $item->nombre = $row['cur_nombre'];
                $item->estado = $row['cur_estado'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getcurso_has_grado(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Curso_has_Grado NATURAL JOIN Curso");

            while($row = $query->fetch()){
                $item = new Curso_has_Grado();
                $item->id = $row['cur_gra_id'];
                $item->grado = $row['gra_id'];
                $item->curso = $row['cur_id'];
                $item->nombre = $row['cur_nombre'];
                $item->estado = $row['cur_gra_estado'];
                
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getpermiso($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=5");
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