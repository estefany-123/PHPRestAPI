<?php

class RutasModel
{

    private $connect;
    private $table = 'Rutas';

    public $nombre;
    public $descripcion;
    public $url_destino;
    public $estado;
    public $fk_modulo;

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
        $query = "SELECT * FROM " . $this->table . " WHERE id_ruta = ?";
        $stmt = $this->connect->prepare($query);

        $id = $id;
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
        $query = "INSERT INTO " . $this->table . "(descripcion,url_destino,estado,fk_modulo) VALUES(?,?,?,?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->descripcion);
        $stmt->bindParam(2, $this->url_destino);
        $stmt->bindParam(3, $this->estado);
        $stmt->bindParam(4, $this->fk_modulo);

        if ($stmt->execute()) {
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }


    public function update($id){
        $query = "UPDATE " . $this->table . " SET descripcion = ?, url_destino = ? WHERE id_ruta = ?";
        $stmt = $this->connect->prepare($query);

        $id = intval($id);
        $stmt->bindParam(1, $this->descripcion);
        $stmt->bindParam(2, $this->url_destino);
        $stmt->bindParam(3, $id);

        if($stmt->execute()){
            return true;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    //No tiene el delete por que no es necesario

    public function patch($id){
        $query = "UPDATE " . $this->table . " SET estado = CASE WHEN estado = true THEN false WHEN estado = false THEN true END WHERE id_ruta = ?";
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
