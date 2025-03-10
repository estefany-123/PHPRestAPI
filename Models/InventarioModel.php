<?php

class InventarioModel
{
    private $connect;
    private $table = 'inventarios';

    public $id;
    public $stock;
    public $estado;
    public $fk_sitio;
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
        $query = "SELECT * FROM " . $this->table . " WHERE id_inventario = $1";
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
        $query = "INSERT INTO " . $this->table . "(stock, estado, fk_sitio, fk_elemento) VALUES($1, $2, $3, $4)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->stock);
        $stmt->bindParam(2, $this->estado);
        $stmt->bindParam(3, $this->fk_sitio);
        $stmt->bindParam(4, $this->fk_elemento);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET stock = $1, estado = $2, fk_sitio = $3, fk_elemento = $4 WHERE id_inventario = $5";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->stock);
        $stmt->bindParam(2, $this->estado);
        $stmt->bindParam(3, $this->fk_sitio);
        $stmt->bindParam(4, $this->fk_elemento);

        $id = intval($id);
        $stmt->bindParam(5, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id_inventario = $1";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = 1 THEN 0 WHEN estado = 0 THEN 1 END WHERE id_inventario = $1";
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
