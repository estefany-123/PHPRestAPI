<?php
class Sedes
{
    private $conn;
    private $table_name = "sedes";

    public $id_sede;
    public $nombre;
    public $estado;
    public $fk_centro;

    public function __construct($db)
    {
        $this->conn = $db;
    }

// funciona
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

// funciona
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_sede = :id_sede";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sede', $id);
        $stmt->execute();
        return $stmt;
    }

//  funciona
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (nombre, estado, fk_centro) 
                  VALUES (:nombre, :estado,  :fk_centro)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_centro', $this->fk_centro);

        return $stmt->execute();
    }

//  funciona
    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, estado = :estado,  fk_centro = :fk_centro
                  WHERE id_sede = :id_sede";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_centro', $this->fk_centro);
        $stmt->bindParam(':id_sede', $id);

        return $stmt->execute();
    }
// funciona
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_sede = :id_sede";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sede', $id);
        return $stmt->execute();
    }
// funciona
    public function patch($id){
        $query = "UPDATE " . $this->table_name . " 
                  SET estado = NOT estado 
                  WHERE id_sede = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
