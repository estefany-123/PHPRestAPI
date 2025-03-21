<?php

class ElementoModel
{
    private $connect;
    private $table = 'elementos';

    public $id;
    public $nombre;
    public $descripcion;
    public $valor;
    public $consumible;
    public $no_consumible;
    public $estado;
    public $imagen_elemento;
    public $fk_unidad_medida;
    public $fk_categoria;
    public $fk_caracteristica;

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
        $query = "SELECT * FROM " . $this->table . " WHERE id_elemento = ?";
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
        $query = "INSERT INTO " . $this->table . "(nombre, descripcion, valor, consumible, no_consumible, estado, imagen_elemento, fk_unidad_medida, fk_categoria, fk_caracteristica) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(3, $this->valor, PDO::PARAM_INT);
        $stmt->bindParam(4, $this->consumible, PDO::PARAM_BOOL);
        $stmt->bindParam(5, $this->no_consumible, PDO::PARAM_BOOL);
        $stmt->bindParam(6, $this->estado, PDO::PARAM_BOOL);
        $stmt->bindParam(7, $this->imagen_elemento, PDO::PARAM_INT);
        $stmt->bindParam(8, $this->fk_unidad_medida, PDO::PARAM_INT);
        $stmt->bindParam(9, $this->fk_categoria, PDO::PARAM_INT);
        $stmt->bindParam(10, $this->fk_caracteristica, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET nombre = ?, descripcion = ?, valor = ?, consumible = ?, no_consumible = ?, estado = ?, imagen_elemento = ?, fk_unidad_medida = ?, fk_categoria = ?, fk_caracteristica = ? WHERE id_elemento = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(3, $this->valor, PDO::PARAM_INT);
        $stmt->bindParam(4, $this->consumible, PDO::PARAM_BOOL);
        $stmt->bindParam(5, $this->no_consumible, PDO::PARAM_BOOL);
        $stmt->bindParam(6, $this->estado, PDO::PARAM_BOOL);
        $stmt->bindParam(7, $this->imagen_elemento, PDO::PARAM_INT);
        $stmt->bindParam(8, $this->fk_unidad_medida, PDO::PARAM_INT);
        $stmt->bindParam(9, $this->fk_categoria, PDO::PARAM_INT);
        $stmt->bindParam(10, $this->fk_caracteristica, PDO::PARAM_INT);

        $id = intval($id);
        $stmt->bindParam(11, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id_elemento = ?";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = true THEN false WHEN estado = false THEN true END WHERE id_elemento = ?";
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
