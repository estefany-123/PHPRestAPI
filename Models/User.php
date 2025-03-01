<?php

class User
{
    private $connect;
    private $table = 'users';

    public $id;
    public $name;
    public $email;

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
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
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
        $query = "INSERT INTO " . $this->table . "(name, email) VALUES(?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->email);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET name = ?, email = ? WHERE id = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->email);

        $id = intval($id);
        $stmt->bindParam(3, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
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
