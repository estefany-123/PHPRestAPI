<?php

class VerificacionModel
{
    private $connect;
    private $table = 'inventarios';

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
        $query = "SELECT * FROM " . $this->table . " WHERE id_verificacion = $1";
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
        $query = "INSERT INTO " . $this->table . "(persona_encargada, persona_asignada, hora_ingreso, hora_fin, fk_inventario) VALUES($1, $2, $3, $4, $5)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->persona_encargada);
        $stmt->bindParam(2, $this->persona_asignada);
        $stmt->bindParam(3, $this->hora_ingreso);
        $stmt->bindParam(4, $this->hora_fin);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET persona_encargada = $1, persona_asignada = $2, hora_ingreso = $3, hora_fin = $4, fk_inventario = $5 WHERE id_verificacion = $6";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->persona_encargada);
        $stmt->bindParam(2, $this->persona_asignada);
        $stmt->bindParam(3, $this->hora_ingreso);
        $stmt->bindParam(4, $this->hora_fin);
        $stmt->bindParam(5, $this->fk_inventario);

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
        $query = "DELETE FROM " . $this->table . " WHERE id_verificacion = $1";
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
