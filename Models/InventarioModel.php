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
        $query = "SELECT * FROM " . $this->table . " WHERE id_inventario = ?";
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
        $query = "INSERT INTO " . $this->table . "(stock, estado, fk_sitio, fk_elemento) VALUES(?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->stock, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->estado, PDO::PARAM_BOOL);
        $stmt->bindParam(3, $this->fk_sitio, PDO::PARAM_INT);
        $stmt->bindParam(4, $this->fk_elemento, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET stock = ?, estado = ?, fk_sitio = ?, fk_elemento = ? WHERE id_inventario = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->stock, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->estado, PDO::PARAM_BOOL);
        $stmt->bindParam(3, $this->fk_sitio, PDO::PARAM_INT);
        $stmt->bindParam(4, $this->fk_elemento, PDO::PARAM_INT);

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
        $query = "DELETE FROM " . $this->table . " WHERE id_inventario = ?";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = true THEN false WHEN estado = false THEN true END WHERE id_inventario = ?";
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
