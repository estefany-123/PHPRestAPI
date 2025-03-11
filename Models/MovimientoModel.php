<?php

class MovimientoModel
{
    private $connect;
    private $table = 'movimientos';

    public $id;
    public $descripcion;
    public $cantidad;
    public $hora_ingreso;
    public $hora_salida;
    public $aceptada;
    public $en_proceso;
    public $cancelada;
    public $devolutivo;
    public $no_devolutivo;
    public $fk_usuario;
    public $fk_tipo_movimiento;
    public $fk_sitio;
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
        $query = "SELECT * FROM " . $this->table . " WHERE id_movimiento = $1";
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
        $query = "INSERT INTO " . $this->table . "(descripción , cantidad, hora_ingreso, hora_salida, aceptada, en proceso, cancelada, devolutivo, no_devolutivo, fk_usuario, fk_tipo_movimiento, fk_sitio, fk_inventario) VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion);
        $stmt->bindParam(2, $this->cantidad);
        $stmt->bindParam(3, $this->hora_ingreso);
        $stmt->bindParam(4, $this->hora_salida);
        $stmt->bindParam(5, $this->aceptada);
        $stmt->bindParam(6, $this->en_proceso);
        $stmt->bindParam(7, $this->cancelada);
        $stmt->bindParam(8, $this->devolutivo);
        $stmt->bindParam(9, $this->no_devolutivo);
        $stmt->bindParam(10, $this->fk_usuario);
        $stmt->bindParam(11, $this->fk_tipo_movimiento);
        $stmt->bindParam(12,$this->fk_sitio);
        $stmt->bindParam(13, $this->fk_inventario);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id){
        $query = "UPDATE " . $this->table . " SET descripcion = $1, cantidad = $2, hora_ingreso = $3, hora_salida = $4, aceptada = $5, en proceso = $6, cancelada = $7, devolutivo = $8, no_devolutivo = $9, fk_usuario = $10, fk_tipo_movimiento = $11, fk_sitio = $12, fk_inventario = $13 WHERE id_movimiento = $14";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion);
        $stmt->bindParam(2, $this->cantidad);
        $stmt->bindParam(3, $this->hora_ingreso);
        $stmt->bindParam(4, $this->hora_salida);
        $stmt->bindParam(5, $this->aceptada);
        $stmt->bindParam(6, $this->en_proceso);
        $stmt->bindParam(7, $this->cancelada);
        $stmt->bindParam(8, $this->devolutivo);
        $stmt->bindParam(9, $this->no_devolutivo);
        $stmt->bindParam(10, $this->fk_usuario);
        $stmt->bindParam(11, $this->fk_tipo_movimiento);
        $stmt->bindParam(12,$this->fk_sitio);
        $stmt->bindParam(13, $this->fk_inventario);

        $id = intval($id);
        $stmt->bindParam(14, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id_movimiento = $1";
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
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = 1 THEN 0 WHEN estado = 0 THEN 1 END WHERE id_movimiento = $1";
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
