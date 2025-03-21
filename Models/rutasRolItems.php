<?php

class rutasRolItems

{
    private $connect;
    private $table = 'rutas_rol_items';

    public $id_ruta_rol;
    public $fk_ruta;
    public $fk_rol_item;

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
    public function getById($id_ruta_rol){
        $query = "SELECT * FROM " . $this->table . " WHERE id_ruta_rol = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id_ruta_rol);
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
        $query = "INSERT INTO " . $this->table . "(fk_ruta, fk_rol_item) VALUES(?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->fk_ruta);
        $stmt->bindParam(2, $this->fk_rol_item);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }


    // funciona
    public function update($id_ruta_rol){
        $query = "UPDATE " . $this->table . " SET fk_ruta = ?, fk_rol_item = ? WHERE id_ruta_rol = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->fk_ruta);
        $stmt->bindParam(2, $this->fk_rol_item);

        $id = intval($id_ruta_rol);
        $stmt->bindParam(3, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }


    // funciona
    public function delete($id_ruta_rol){
        $query = "DELETE FROM " . $this->table . " WHERE id_ruta_rol = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id_ruta_rol);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }


  


}
