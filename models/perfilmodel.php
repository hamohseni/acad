<?php

include_once 'entidades/persona.php';
class perfilModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function getpermiso($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=7");
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
    public function getdatospersonales($datos){
        $items = [];
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Cargo NATURAL JOIN Persona_has_Cargo WHERE per_identificacion=:identificacion");
            $query->execute(['identificacion' => $datos]);
            while($row = $query->fetch()){
                $item = new Persona();
                $item->id = $row['per_id'];
                $item->nombre = $row['per_nombre'];
                $item->apellido = $row['per_apellido'];
                $item->identificacion = $row['per_identificacion'];
                $item->telefono = $row['per_telefono'];
                $item->celular = $row['per_celular'];
                $item->correo = $row['per_correo'];
                $item->codigo = $row['per_codigo'];
                $item->direccion = $row['per_direccion'];
                $item->pais = $row['per_pais'];
                $item->ciudad = $row['per_nacimiento'];
                $item->nacimiento = $row['per_nacimiento'];
                $item->ingreso = $row['per_ingreso'];
                $item->grado = $row['per_grado'];
                $item->contrasena = $row['per_contrasena'];
                $item->imagen = $row['per_imagen'];
                $item->tipodocumento = $row['per_tipo_documento'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }



}

?>