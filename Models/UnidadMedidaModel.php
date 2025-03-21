<?php

class UnidadMedidaModel
{
    private $connect;
    private $table = 'unidades_medida';

    public $id;
    public $nombre;
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

    public function getById($id){
        $query = "SELECT * FROM " . $this->table . " WHERE id_unidad = ?";
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
        $query = "INSERT INTO " . $this->table . "(nombre, estado) VALUES(?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->estado, PDO::PARAM_BOOL);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET nombre = ?, estado = ? WHERE id_unidad = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->estado, PDO::PARAM_BOOL);

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
        $query = "DELETE FROM " . $this->table . " WHERE id_unidad = ?";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = true THEN false WHEN estado = false THEN true END WHERE id_unidad = ?";
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
