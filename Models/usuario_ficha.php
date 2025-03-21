<?php

class usuarioficha

{
    private $connect;
    private $table = 'usuario_ficha';

    public $id_usuario_ficha;
    public $fk_usuario;
    public $fk_ficha;

    public function __construct($db){
        $this->connect = $db;
    }

    // funciona
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

    // funciona
    public function getById($id_usuario_ficha){
        $query = "SELECT * FROM " . $this->table . " WHERE id_usuario_ficha = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id_usuario_ficha);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
// funciona
    public function create(){
        $query = "INSERT INTO " . $this->table . "(fk_usuario, fk_ficha) VALUES(?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->fk_usuario);
        $stmt->bindParam(2, $this->fk_ficha);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    // funciona
    public function update($id_usuario_ficha){
        $query = "UPDATE " . $this->table . " SET fk_usuario = ?, fk_ficha = ? WHERE id_usuario_ficha = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->fk_usuario);
        $stmt->bindParam(2, $this->fk_ficha);

        $id = intval($id_usuario_ficha);
        $stmt->bindParam(3, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }


// funciona
    public function delete($id_usuario_ficha){
        $query = "DELETE FROM " . $this->table . " WHERE id_usuario_ficha = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id_usuario_ficha);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}
