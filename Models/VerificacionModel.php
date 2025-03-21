<?php

class VerificacionModel
{
    private $connect;
    private $table = 'verificaciones';

    public $id;
    public $persona_encargada;
    public $persona_asignada;
    public $hora_ingreso;
    public $hora_fin;
    public $fk_inventario;

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
        $query = "SELECT * FROM " . $this->table . " WHERE id_verificacion = ?";
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
        $query = "INSERT INTO " . $this->table . "(persona_encargada, persona_asignada, hora_ingreso, hora_fin, fk_inventario) VALUES(?,?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->persona_encargada, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->persona_asignada, PDO::PARAM_STR);
        $stmt->bindParam(3, $this->hora_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(4, $this->hora_fin, PDO::PARAM_STR);
        $stmt->bindParam(5, $this->fk_inventario, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET persona_encargada = ?, persona_asignada = ?, hora_ingreso = ?, hora_fin = ?, fk_inventario = ? WHERE id_verificacion = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->persona_encargada, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->persona_asignada, PDO::PARAM_STR);
        $stmt->bindParam(3, $this->hora_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(4, $this->hora_fin, PDO::PARAM_STR);
        $stmt->bindParam(5, $this->fk_inventario, PDO::PARAM_INT);

        $id = intval($id);
        $stmt->bindParam(6, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id_verificacion = ?";
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
