<?php

include_once 'entidades/persona.php';
class perfilModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function getpermisopaginaperfil($datos){
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
    public function getpermisopaginacambiarcontrasena($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=9");
            $query->execute(['identificacion' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_perm_estado;
            return $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }
    public function getpermisopaginacambiarinformacion($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=10");
            $query->execute(['identificacion' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_perm_estado;
            return $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }
    public function getpermisocambiardatos($datos,$perm){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=:permiso");
            $query->execute(['identificacion' => $datos,'permiso' => $perm]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_perm_estado;
            return $result;
        }catch(PDOException $e){
            echo "no se pudo";
            return [];
        }
    }
    public function getpermisocambiartelefono($datos){
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Permiso NATURAL JOIN Persona_has_Permiso WHERE per_identificacion=:identificacion AND perm_id=15");
            $query->execute(['identificacion' => $datos]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $result = $row->per_perm_estado;
            return $result;
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
                $item->ciudad = $row['per_ciudad'];
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
    public function getdatos($datos){
        $item = new Persona;
        try{

            $query = $this->db->connect()->prepare("SELECT * FROM Persona NATURAL JOIN Cargo NATURAL JOIN Persona_has_Cargo WHERE per_identificacion=:identificacion");
            $query->execute(['identificacion' => $datos]);
            while($row = $query->fetch()){
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
                $item->ciudad = $row['per_ciudad'];
                $item->nacimiento = $row['per_nacimiento'];
                $item->ingreso = $row['per_ingreso'];
                $item->grado = $row['per_grado'];
                $item->contrasena = $row['per_contrasena'];
                $item->imagen = $row['per_imagen'];
                $item->tipodocumento = $row['per_tipo_documento'];
            }
            return $item;
        }catch(PDOException $e){
            echo "no se pudo";
            return null;
        }
    }
    public function actualizarinformacion($item){
        $query = $this->db->connect()->prepare('UPDATE Persona SET per_nombre = :nombre,per_apellido = :apellido, per_tipo_documento = :tipodocumento, per_identificacion = :identificacionnueva, per_pais = :pais, per_ciudad = :ciudad, per_nacimiento = :nacimiento,per_telefono = :telefono, per_celular = :celular, per_direccion = :direccion, per_correo = :correo WHERE per_identificacion = :identificacion');
        try{
            $query->execute([
                'nombre' => $item['nombre'],
                'apellido' => $item['apellido'],
                'identificacionnueva' => $item['identificacionnueva'],
                'pais' => $item['pais'],
                'ciudad' => $item['ciudad'],
                'nacimiento' => $item['nacimiento'],
                'tipodocumento' => $item['tipodocumento'],
                'telefono' => $item['telefono'],
                'direccion' => $item['direccion'],
                'celular' => $item['celular'],
                'correo' => $item['correo'],
                'identificacion' => $item['identificacion']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function getcontrasena($datos){
        try{
            $query = $this->db->connect()->prepare("SELECT per_contrasena FROM Persona WHERE per_identificacion=:identificacion");
            $query->execute(['identificacion' => $datos['identificacion']]);
            $row= $query->fetch(PDO::FETCH_OBJ);
            return $row->per_contrasena;
        }catch(PDOException $e){
            return [];
        }
    }
    public function actualizarinformacionimagen($item){
        $query = $this->db->connect()->prepare('UPDATE Persona SET per_imagen = :imagen WHERE per_identificacion = :identificacion');
        try{
            $query->execute([
                'imagen' => $item['imagen'],
                'identificacion' => $item['identificacion']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function actualizarinformacioncontrasena($item){
        $query = $this->db->connect()->prepare('UPDATE Persona SET per_contrasena = :contrasena WHERE per_identificacion = :identificacion');
        try{
            $query->execute([
                'contrasena' => $item['contrasena'],
                'identificacion' => $item['identificacion']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }



}

?>