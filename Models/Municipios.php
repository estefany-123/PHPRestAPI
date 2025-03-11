<?php

class municipios
{
    private $connect;
    private $table = 'municipios';

    public $id_municipio;
    public $nombre;
    public $departamento;
    public $estado;
    public $created_at;
    public $updated_at;

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

    public function getById($id_municipio){
        $query = "SELECT * FROM " . $this->table . " WHERE id_municipio = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id_municipio);
        $stmt->bindParam(1, $id_municipio);

        if($stmt->execute()){
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function create(){
        $query = "INSERT INTO " . $this->table . "(nombre, departamento,estado,created_at,updated_at) VALUES(?,?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->departamento);
        $stmt->bindParam(3, $this->estado);
        $stmt->bindParam(4, $this->created_at);
        $stmt->bindParam(5, $this->updated_at);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id_municipio){
        $query = "UPDATE " . $this->table . " SET nombre = ?, departamento = ?,estado = ?,created_at = ?,updated_at = ? WHERE id_municipio = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->departamento);
        $stmt->bindParam(3, $this->estado);
        $stmt->bindParam(4, $this->created_at);
        $stmt->bindParam(5, $this->updated_at);

        $id = intval($id_municipio);
        $stmt->bindParam(3, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id_municipio){
        $query = "DELETE FROM " . $this->table . " WHERE id_municipio = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id_municipio);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function patch($id_municipio){
        $query = "UPDATE " . $this->table . " SET status = CASE WHEN status = 1 THEN 0 WHEN status = 0 THEN 1 END WHERE id_municipio = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id_municipio);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}
