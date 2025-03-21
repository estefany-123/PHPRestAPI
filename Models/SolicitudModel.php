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
    public $fk_inventario;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getAll()
    {

        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_solicitud = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . "(descripcion, cantidad, aceptada, pendiente, rechazada, fk_usuario, fk_inventario) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(3, $this->aceptada, PDO::PARAM_BOOL);
        $stmt->bindParam(4, $this->pendiente, PDO::PARAM_BOOL);
        $stmt->bindParam(5, $this->rechazada, PDO::PARAM_BOOL);
        $stmt->bindParam(6, $this->fk_usuario, PDO::PARAM_INT);
        $stmt->bindParam(7, $this->fk_inventario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id)
    {
        $query = "UPDATE " . $this->table . " SET descripcion = ?, cantidad = ?, aceptada = ?, pendiente = ?, rechazada = ?, fk_usuario = ?, fk_inventario = ? WHERE id_solicitud = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(3, $this->aceptada, PDO::PARAM_BOOL);
        $stmt->bindParam(4, $this->pendiente, PDO::PARAM_BOOL);
        $stmt->bindParam(5, $this->rechazada, PDO::PARAM_BOOL);
        $stmt->bindParam(6, $this->fk_usuario, PDO::PARAM_INT);
        $stmt->bindParam(7, $this->fk_inventario, PDO::PARAM_INT);

        $id = intval($id);
        $stmt->bindParam(8, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_solicitud = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function patch($id)
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        $estado = $data['estado'];

        $query = "UPDATE " . $this->table . " SET aceptada = (CASE WHEN ? = 'aceptada' THEN TRUE ELSE FALSE END), pendiente = (CASE WHEN ? = 'pendiente' THEN TRUE ELSE FALSE END), rechazada = (CASE WHEN ? = 'rechazada' THEN TRUE ELSE FALSE END) WHERE id_solicitud = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);

        $stmt->bindParam(1, $estado, PDO::PARAM_STR);
        $stmt->bindParam(2, $estado, PDO::PARAM_STR);
        $stmt->bindParam(3, $estado, PDO::PARAM_STR);
        $stmt->bindParam(4, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}
