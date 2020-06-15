<?php

include_once 'entidades/ano.php';
include_once 'entidades/periodo.php';
include_once 'entidades/ano_has_periodo.php';
include_once 'entidades/grado_has_asignatura.php';

class anoacademicoModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public function insertano($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Ano (ano_nombre,ano_fecha_inicial,ano_fecha_final,ano_estado) VALUES (:nombre,:inicial,:final,:estado)');
            $query->execute(['nombre' => $datos['nombre'],'inicial' => $datos['fechainicial'],'final' => $datos['fechafinal'],'estado' => $datos['estado']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }  
    public function insertperiodo($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Periodo (per_nombre,per_fecha_inicial,per_fecha_final,per_estado) VALUES (:nombre,:inicial,:final,:estado)');
            $query->execute(['nombre' => $datos['nombre'],'inicial' => $datos['fechainicial'],'final' => $datos['fechafinal'],'estado' => $datos['estado']]);
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
                $item->fechainicial = $row['ano_fecha_inicial'];
                $item->fechafinal = $row['ano_fecha_final'];
                $item->estado = $row['ano_estado'];

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
                $item->periodonombre = $row['per_nombre'];
                $item->periodofechainicial = $row['per_fecha_inicial'];
                $item->periodofechafinal = $row['per_fecha_final'];
                $item->periodoestado = $row['per_estado'];
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
    public function getultimoasignaturagrado(){
        try{
            $query = $this->db->connect()->query("SELECT gra_asi_id, ano_per_id FROM Grado NATURAL JOIN Asignatura NATURAL JOIN Ano_has_Periodo NATURAL JOIN Grado_has_Asignatura ORDER BY gra_asi_id DESC LIMIT 1");
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->gra_asi_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getanoperiodo(){
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
    public function gettotalasignaturas(){
        try{
            $query = $this->db->connect()->query("SELECT COUNT(gra_asi_id) AS total FROM Grado_has_Asignatura WHERE ano_per_id = (SELECT ano_per_id FROM Grado_has_Asignatura ORDER BY ano_per_id DESC LIMIT 1)");
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->total;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getgrado($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT gra_id FROM Grado_has_Asignatura WHERE gra_asi_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->gra_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getasignatura($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT asi_id FROM Grado_has_Asignatura WHERE gra_asi_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->asi_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function insertgrado_has_asignatura($grado,$asignatura,$ano){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Grado_has_Asignatura (gra_id,asi_id,ano_per_id) VALUES (:grado,:asignatura,:ano)');
            $query->execute(['grado' => $grado,'asignatura' => $asignatura,'ano' => $ano]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }  
    }   
    public function getultimopersonacurso(){
        try{
            $query = $this->db->connect()->query("SELECT per_asi_cur_id FROM Persona_has_Asignatura_has_Curso ORDER BY per_asi_cur_id DESC LIMIT 1");
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_asi_cur_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function gettotalgradoasignaturas(){
        try{
            $query = $this->db->connect()->query("SELECT COUNT(per_asi_cur_id) AS total FROM Persona_has_Asignatura_has_Curso WHERE ano_per_id = (SELECT ano_per_id FROM Persona_has_Asignatura_has_Curso ORDER BY ano_per_id DESC LIMIT 1)");
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->total;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getgrado2($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT gra_id FROM Persona_has_Asignatura_has_Curso WHERE per_asi_cur_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->gra_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getasignatura2($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT asi_id FROM Persona_has_Asignatura_has_Curso WHERE per_asi_cur_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->asi_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getcurso2($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT cur_id FROM Persona_has_Asignatura_has_Curso WHERE per_asi_cur_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->cur_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getpersona2($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT per_id FROM Persona_has_Asignatura_has_Curso WHERE per_asi_cur_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_id;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function getrotativo2($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT per_asi_cur_rotativo FROM Persona_has_Asignatura_has_Curso WHERE per_asi_cur_id=:grado");
            $query->execute(['grado' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_asi_cur_rotativo;
            return $result;    
        }catch(PDOException $e){
            echo "no se pudo1";
            return [];
        }
    }
    public function insertpersona_has_asignatura_has_curso($grado,$asignatura,$ano,$curso,$persona,$rotativo){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Persona_has_Asignatura_has_Curso (gra_id,asi_id,ano_per_id,cur_id,per_id,per_asi_cur_rotativo) VALUES (:grado,:asignatura,:ano,:curso,:persona,:rotativo)');
            $query->execute(['grado' => $grado,'asignatura' => $asignatura,'ano' => $ano,'curso' => $curso,'persona' => $persona,'rotativo' => $rotativo]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo";
            return false;
        }
            
    }   
}

?>