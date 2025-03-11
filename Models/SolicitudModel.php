<?php

class SolicitudModel
{
    private $connect;
    private $table = 'solicitudes';

    public $id;
    public $descripcion;
    public $cantidad;
    public $aceptada;
    public $pendiente;
    public $rechazada;
    public $fk_usuario;
    public $fk_elemento;

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
        $query = "SELECT * FROM " . $this->table . " WHERE id_solicitud = $1";
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
        $query = "INSERT INTO " . $this->table . "(descripcion, cantidad, aceptada, pendiente, rechazada, fk_usuario, fk_elemento) VALUES($1, $2, $3, $4, $5, $6, $7)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion);
        $stmt->bindParam(2, $this->cantidad);
        $stmt->bindParam(3, $this->aceptada);
        $stmt->bindParam(4, $this->pendiente);
        $stmt->bindParam(5, $this->rechazada);
        $stmt->bindParam(6, $this->fk_usuario);
        $stmt->bindParam(7, $this->fk_elemento);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET descripcion = $1, cantidad = $2, aceptada = $3, pendiente = $4, rechazada = $5, fk_usuario = $6, fk_elemento = $7 WHERE id_solicitud = $8";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion);
        $stmt->bindParam(2, $this->cantidad);
        $stmt->bindParam(3, $this->aceptada);
        $stmt->bindParam(4, $this->pendiente);
        $stmt->bindParam(5, $this->rechazada);
        $stmt->bindParam(6, $this->fk_usuario);
        $stmt->bindParam(7, $this->fk_elemento);

        $id = intval($id);
        $stmt->bindParam(8, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id_solicitud = $1";
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
        $query = "UPDATE " . $this->table . " SET aceptada = CASE WHEN aceptada = 1 THEN 0 END, pendiente = CASE WHEN aceptada = 1 THEN 0 END, rechazada = CASE WHEN aceptada = 1 THEN 0 END WHERE id_solicitud = $1";
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
