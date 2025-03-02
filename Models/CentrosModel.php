<?php

class CentrosModel
{
    private $connect;
    private $table = 'Centros';

    public $nombre;

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
        $query = "SELECT * FROM " . $this->table . " WHERE id_centro = ?";
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
        $query = "INSERT INTO " . $this->table . "(nombre) VALUES(?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET nombre = ? WHERE id_centro = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id_centro = ?";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = 1 THEN 0 WHEN estado = 0 THEN 1 END WHERE id_centro = ?";
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