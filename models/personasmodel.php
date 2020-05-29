<?php

include_once 'entidades/cargo.php';
class personasModel extends Model{

    public function __construct(){
        parent:: __construct();
    }

    public function insertpersona($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Persona (per_nombre,per_apellido,per_identificacion,per_telefono,per_celular,per_correo,per_codigo,per_direccion,per_pais,per_ciudad,per_nacimiento,per_ingreso,per_contrasena,per_imagen,per_tipo_documento) VALUES (:nombre,:apellido,:identificacion,:telefono,:celular,:correo,:codigo,:direccion,:pais,:ciudad,:nacimiento,:ingreso,:contrasena,:imagen,:tipodocumento)');
            $query->execute(['nombre' => $datos['nombre'],'apellido' => $datos['apellido'],'identificacion' => $datos['identificacion'],'telefono' => $datos['telefono'],'celular' => $datos['celular'],'correo' => $datos['correo'],'codigo' => $datos['codigo'],'direccion' => $datos['direccion'],'pais' => $datos['pais'],'ciudad' => $datos['ciudad'],'nacimiento' => $datos['nacimiento'],'ingreso' => $datos['ingreso'],'contrasena' => $datos['contrasena'],'imagen' => $datos['imagen'],'tipodocumento' => $datos['tipodocumento']]);

            return true;
        }catch(PDOException $e){
            echo "no se pudo1";
            return false;
        } 
    }
    public function insertpersonahascargo($datos){
        try{
            $query1 = $this->db->connect()->prepare('SELECT per_id FROM Persona WHERE per_identificacion=:identificacion');
            $query1->execute(['identificacion' => $datos['identificacion']]);
            $row= $query1->fetch(PDO::FETCH_OBJ);
            $result = $row->per_id;
            $query = $this->db->connect()->prepare('INSERT INTO Persona_has_Cargo (per_id,car_id) VALUES(:result,:cargo)');
            $query->execute(['result' => $result,'cargo' => $datos['cargo']]);
            return true;
        }catch(PDOException $e){
            echo "no se pudo2";
            return false;
        } 
    }

    public function getcargo(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM Cargo");
            while($row = $query->fetch()){
                $item = new Cargo();
                $item->id = $row['car_id'];
                $item->nombre = $row['car_nombre'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getpermiso($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=6");
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