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
    public $aceptado;
    public $en_proceso;
    public $cancelado;
    public $devolutivo;
    public $no_devolutivo;
    public $fk_usuario;
    public $fk_tipo_movimiento;
    public $fk_sitio;
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
        $query = "SELECT * FROM " . $this->table . " WHERE id_movimiento = ?";
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
        $query = "INSERT INTO " . $this->table . "(descripcion , cantidad, hora_ingreso, hora_salida, aceptado, en_proceso, cancelado, devolutivo, no_devolutivo, fk_usuario, fk_tipo_movimiento, fk_sitio, fk_inventario) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(3, $this->hora_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(4, $this->hora_salida, PDO::PARAM_STR);
        $stmt->bindParam(5, $this->aceptado, PDO::PARAM_BOOL);
        $stmt->bindParam(6, $this->en_proceso, PDO::PARAM_BOOL);
        $stmt->bindParam(7, $this->cancelado, PDO::PARAM_BOOL);
        $stmt->bindParam(8, $this->devolutivo, PDO::PARAM_BOOL);
        $stmt->bindParam(9, $this->no_devolutivo, PDO::PARAM_BOOL);
        $stmt->bindParam(10, $this->fk_usuario, PDO::PARAM_INT);
        $stmt->bindParam(11, $this->fk_tipo_movimiento, PDO::PARAM_INT);
        $stmt->bindParam(12, $this->fk_sitio, PDO::PARAM_INT);
        $stmt->bindParam(13, $this->fk_inventario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function update($id)
    {
        $query = "UPDATE " . $this->table . " SET descripcion = ?, cantidad = ?, hora_ingreso = ?, hora_salida = ?, aceptado = ?, en_proceso = ?, cancelado = ?, devolutivo = ?, no_devolutivo = ?, fk_usuario = ?, fk_tipo_movimiento = ?, fk_sitio = ?, fk_inventario = ? WHERE id_movimiento = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(3, $this->hora_ingreso, PDO::PARAM_STR);
        $stmt->bindParam(4, $this->hora_salida, PDO::PARAM_STR);
        $stmt->bindParam(5, $this->aceptado, PDO::PARAM_BOOL);
        $stmt->bindParam(6, $this->en_proceso, PDO::PARAM_BOOL);
        $stmt->bindParam(7, $this->cancelado, PDO::PARAM_BOOL);
        $stmt->bindParam(8, $this->devolutivo, PDO::PARAM_BOOL);
        $stmt->bindParam(9, $this->no_devolutivo, PDO::PARAM_BOOL);
        $stmt->bindParam(10, $this->fk_usuario, PDO::PARAM_INT);
        $stmt->bindParam(11, $this->fk_tipo_movimiento, PDO::PARAM_INT);
        $stmt->bindParam(12, $this->fk_sitio, PDO::PARAM_INT);
        $stmt->bindParam(13, $this->fk_inventario, PDO::PARAM_INT);

        $id = intval($id);
        $stmt->bindParam(14, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_movimiento = ?";
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

        $query = "UPDATE " . $this->table . " SET aceptado = CASE WHEN ? = 'aceptado' THEN TRUE ELSE FALSE END, 
        en_proceso = CASE WHEN ? = 'en_proceso' THEN TRUE ELSE FALSE END,
        cancelado = CASE WHEN ? = 'cancelado' THEN TRUE ELSE FALSE END 
        WHERE id_movimiento = ?";
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
