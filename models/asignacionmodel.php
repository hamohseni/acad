<?php

include_once 'entidades/grado.php';
include_once 'entidades/asignatura.php';
include_once 'entidades/persona.php';
include_once 'entidades/curso.php';

class asignacionModel extends Model{

    public function __construct(){
        parent:: __construct();
        
    }

    public function getgrado(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM Grado ORDER BY gra_peso DESC");
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
    public function getcurso($datos){
        $items = [];
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM Curso NATURAL JOIN Curso_has_Grado WHERE gra_id=:grado");
            $query->execute(['grado'=>$datos]);
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
    public function getpersona($datos){
        $items = [];
        
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Cargo NATURAL JOIN Persona_has_Cargo WHERE car_id = 2  AND per_nombre LIKE ?" );
            $query->execute(array('%' . $datos . '%'));
            while($row = $query->fetch()){
                $item = new Persona();
                $item->id = $row['per_id'];
                $item->nombre = $row['per_nombre'];
                $item->identificacion = $row['per_identificacion'];

                array_push($items, $item);
            }
            
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getpersonad(){
        $items = [];
        
        try{
            $query = $this->db->connect()->query("SELECT * FROM Persona NATURAL JOIN Cargo NATURAL JOIN Persona_has_Cargo WHERE car_id = 2" );
            while($row = $query->fetch()){
                $item = new Persona();
                $item->id = $row['per_id'];
                $item->nombre = $row['per_nombre'];
                $item->identificacion = $row['per_identificacion'];
                $item->imagen = $row['per_imagen'];

                array_push($items, $item);
            }
            
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getestudiantesinmatricula(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM Persona NATURAL JOIN Cargo NATURAL JOIN Persona_has_Cargo WHERE car_id = 1  AND per_estado=0" );
            while($row = $query->fetch()){
                $item = new Persona();
                $item->id = $row['per_id'];
                $item->nombre = $row['per_nombre'];
                $item->apellido = $row['per_apellido'];
                $item->identificacion = $row['per_identificacion'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getestudianteconmatricula($grado,$curso){
        $items = [];
        
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Cargo NATURAL JOIN Persona_has_Cargo NATURAL JOIN Matricula WHERE car_id = 1 AND per_estado=1 AND gra_id=:grado AND cur_id=:curso AND mat_estado=1" );
            $query->execute(['grado'=>$grado,'curso'=>$curso ]);
            while($row = $query->fetch()){
                $item = new Persona();
                $item->id = $row['per_id'];
                $item->nombre = $row['per_nombre'];
                $item->apellido = $row['per_apellido'];
                $item->identificacion = $row['per_identificacion'];
                array_push($items, $item);
            }
            
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getasignatura($datos){
        $items = [];
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM Asignatura NATURAL JOIN Grado_has_Asignatura WHERE gra_id=:grado AND ano_per_id=(SELECT ano_per_id FROM ano_has_periodo ORDER BY ano_per_id DESC LIMIT 1)");
            $query->execute(['grado'=>$datos]);
            while($row = $query->fetch()){
                $item = new Asignatura();
                $item->id = $row['asi_id'];
                $item->nombre = $row['asi_nombre'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getpermiso($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=3");
            $query->execute(['identificacion' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_perm_estado;
            return $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }
    public function getgradopeso($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT gra_peso FROM Grado WHERE gra_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->gra_peso;
            return $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }
    public function getgradoultimopeso(){
        try{
            $query = $this->db->connect()->query("SELECT gra_peso FROM Grado ORDER BY gra_peso DESC LIMIT 1");
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->gra_peso;
            return $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }
    public function getperiodo(){
        try{
            $query = $this->db->connect()->query("SELECT ano_per_id FROM Ano_has_Periodo  ORDER BY ano_per_id DESC LIMIT 1");
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->ano_per_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getano(){
        try{
            $query = $this->db->connect()->query("SELECT ano_id FROM Ano ORDER BY ano_id DESC LIMIT 1");
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->ano_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    
    public function insertpersonahasasignatura($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Persona_has_Asignatura_has_Curso (cur_id,gra_id,asi_id,ano_per_id,per_asi_cur_rotativo,per_id) VALUES (:curso,:grado,:asignatura,:periodo,:rotativo,:persona)');
            $query->execute(['curso' => $datos['curso'],'grado' => $datos['grado'],'asignatura' => $datos['asignatura'],'periodo' => $datos['periodo'],'rotativo' => $datos['rotativo'],'persona' => $datos['persona']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   
    public function insertmatriculaestudiante($datos){
        try{
            
            $query = $this->db->connect()->prepare('INSERT INTO Matricula (cur_id,gra_id,ano_id,per_id, mat_fecha, mat_estado) VALUES (:curso,:grado,:ano,:persona,:fecha,1)');
            $query->execute(['curso' => $datos['curso'],'grado' => $datos['grado'],'ano' => $datos['ano'],'persona' => $datos['persona'],'fecha' => $datos['fecha']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   
    public function updatematricula($datos,$estado){
        try{
            $query = $this->db->connect()->prepare('UPDATE Matricula SET mat_estado=:estado WHERE mat_id =:materia');
            $query->execute(['estado' => $estado,'materia' => $datos]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }      
    }
    public function getidpersonamatricula($datos){
        try{
            $query= $this->db->connect()->prepare('SELECT mat_id FROM Matricula WHERE per_id=:persona ORDER BY mat_id DESC LIMIT 1');
            $query->execute(['persona'=> $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->mat_id;
            return $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }      
    }  
}

?>