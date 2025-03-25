<?php

class UsuariosModel
{
    private $connect;
    private $table = 'Usuarios';

    public $documento;
    public $nombre;
    public $apellido;
    public $edad;
    public $telefono;
    public $correo;
    public $estado;
    public $cargo;
    public $password;
    public $fk_rol;


    public function __construct($db){
        $this->connect = $db;
    }

    public function getAll(){

        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function getById($id){
        $query = "SELECT * FROM " . $this->table . " WHERE id_usuario = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
    
    public function login($correo, $password){
        $query = "SELECT * FROM " . $this->table . " WHERE correo = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $correo);
        
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($password,$user["password"])){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function create(){
        $query = "INSERT INTO " . $this->table . "(documento,nombre,apellido,edad,telefono,correo,estado,cargo,password,fk_rol) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->documento);
        $stmt->bindParam(2, $this->nombre);
        $stmt->bindParam(3, $this->apellido);
        $stmt->bindParam(4, $this->edad);
        $stmt->bindParam(5, $this->telefono);
        $stmt->bindParam(6, $this->correo);
        $stmt->bindParam(7, $this->estado);
        $stmt->bindParam(8, $this->cargo);
        $stmt->bindParam(9, $this->password);
        $stmt->bindParam(10, $this->fk_rol);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET documento = ?, nombre = ?, apellido = ?, edad = ?, telefono = ?, correo = ?, estado = ?, cargo = ?, password = ? WHERE id_usuario = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $this->documento);
        $stmt->bindParam(2, $this->nombre);
        $stmt->bindParam(3, $this->apellido);
        $stmt->bindParam(4, $this->edad);
        $stmt->bindParam(5, $this->telefono);
        $stmt->bindParam(6, $this->correo);
        $stmt->bindParam(7, $this->estado);
        $stmt->bindParam(8, $this->cargo);
        $stmt->bindParam(9, $this->password);
        $stmt->bindParam(10, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id_usuario = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function patch($id){
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = true THEN false WHEN estado =  false THEN true END WHERE id_usuario = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}