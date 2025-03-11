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
        $query = "SELECT * FROM " . $this->table . " WHERE id_elemento = $1";
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
        $query = "INSERT INTO " . $this->table . "(nombre, descripcion, valor, consumible, no_consumible, estado, imagen_elemento, fk_unidad_medida, fk_categoria, fk_caracteristica) VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->descripcion);
        $stmt->bindParam(3, $this->valor);
        $stmt->bindParam(4, $this->consumible);
        $stmt->bindParam(5, $this->no_consumible);
        $stmt->bindParam(6, $this->estado);
        $stmt->bindParam(7, $this->imagen_elemento);
        $stmt->bindParam(8, $this->fk_unidad_medida);
        $stmt->bindParam(9, $this->fk_categoria);
        $stmt->bindParam(10, $this->fk_caracteristica);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET nombre = $1, descripcion = $2, valor = $3, consumible = $4, no_consumible = $5, estado = $6, imagen_elemento = $7, fk_unidad_medida = $8, fk_categoria = $9, fk_caracteristica = $10 WHERE id_elemento = $11";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->descripcion);
        $stmt->bindParam(3, $this->valor);
        $stmt->bindParam(4, $this->consumible);
        $stmt->bindParam(5, $this->no_consumible);
        $stmt->bindParam(6, $this->estado);
        $stmt->bindParam(7, $this->imagen_elemento);
        $stmt->bindParam(8, $this->fk_unidad_medida);
        $stmt->bindParam(9, $this->fk_categoria);
        $stmt->bindParam(10, $this->fk_caracteristica);

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
        $query = "DELETE FROM " . $this->table . " WHERE id_elemento = $1";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = 1 THEN 0 WHEN estado = 0 THEN 1 END WHERE id_elemento = $1";
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
