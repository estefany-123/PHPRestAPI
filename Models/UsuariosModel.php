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
    public $cargo;
    public $password;


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

    public function create(){
        $query = "INSERT INTO " . $this->table . "(documento,nombre,apellido,edad,telefono,correo,cargo,password) VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->documento);
        $stmt->bindParam(2, $this->nombre);
        $stmt->bindParam(3, $this->apellido);
        $stmt->bindParam(4, $this->edad);
        $stmt->bindParam(5, $this->telefono);
        $stmt->bindParam(6, $this->correo);
        $stmt->bindParam(7, $this->cargo);
        $stmt->bindParam(8, $this->password);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET documento = ?, nombre = ?, apellido = ?, edad = ?, telefono = ?, correo = ?, cargo = ?, password = ? WHERE id_usuario = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $this->documento);
        $stmt->bindParam(2, $this->nombre);
        $stmt->bindParam(3, $this->apellido);
        $stmt->bindParam(4, $this->edad);
        $stmt->bindParam(5, $this->telefono);
        $stmt->bindParam(6, $this->correo);
        $stmt->bindParam(7, $this->cargo);
        $stmt->bindParam(8, $this->password);
        $stmt->bindParam(9, $id);

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
}