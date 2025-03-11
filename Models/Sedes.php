<?php
class Sedes
{
    private $conn;
    private $table_name = "sedes";

    public $id_sede;
    public $nombre;
    public $estado;
    public $created_at;
    public $updated_at;
    public $fk_centro;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

   
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_sede = :id_sede";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sede', $id);
        $stmt->execute();
        return $stmt;
    }

 
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (nombre, estado, created_at, updated_at, fk_centro) 
                  VALUES (:nombre, :estado, :created_at, :updated_at, :fk_centro)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':fk_centro', $this->fk_centro);

        return $stmt->execute();
    }

 
    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, estado = :estado, created_at = :created_at, updated_at = :updated_at, fk_centro = :fk_centro
                  WHERE id_sede = :id_sede";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':fk_centro', $this->fk_centro);
        $stmt->bindParam(':id_sede', $id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_sede = :id_sede";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sede', $id);
        return $stmt->execute();
    }
}
