<?php

class MunicipiosModel
{
    private $connect;
    private $table = 'Municipios';

    public $nombre;
    public $departamento;
    public $estado;

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

    public function getById($nombre){
        $query = "SELECT * FROM " . $this->table . " WHERE nombre LIKE ?";
        $stmt = $this->connect->prepare($query);

        $nombre = "%$nombre%";
        $stmt->bindParam(1, $nombre);

        if($stmt->execute()){
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function create(){
        $query = "INSERT INTO " . $this->table . "(nombre, departamento,estado) VALUES(?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->departamento);
        $stmt->bindParam(3, $this->estado);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET nombre = ?, departamento = ? WHERE id_municipio = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->departamento);

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
        $query = "DELETE FROM " . $this->table . " WHERE id_municipio = ?";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = true THEN false WHEN estado = false THEN true END WHERE id_municipio = ?";
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
