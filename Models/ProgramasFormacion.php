<?php
class ProgramasFormacion
{
    private $conn;
    private $table_name = "programas_formacion";

    public $id_programa;
    public $nombre;
    public $estado;
    public $created_at;
    public $updated_at;
    public $fk_area;

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_programa = :id_programa";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_programa', $id);
        $stmt->execute();
        return $stmt;
    }

// funciona
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (nombre, estado, fk_area) 
                  VALUES (:nombre, :estado, :fk_area)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_area', $this->fk_area);

        return $stmt->execute();
    }

    // funciona
    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, estado = :estado,  fk_area = :fk_area
                  WHERE id_programa = :id_programa";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_area', $this->fk_area);
        $stmt->bindParam(':id_programa', $id);

        return $stmt->execute();
    }

//    funciona
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_programa = :id_programa";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_programa', $id);
        return $stmt->execute();
    }
// funciona
    public function patch($id){
        $query = "UPDATE " . $this->table_name . " 
                  SET estado = NOT estado 
                  WHERE id_programa = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
