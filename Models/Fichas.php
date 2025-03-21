<?php
class Fichas
{
    private $conn;
    private $table_name = "fichas";

    public $id_ficha;
    public $codigo_ficha;
    public $estado;
    public $created_at;
    public $updated_at;
    public $fk_programa;

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_ficha = :id_ficha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_ficha', $id);
        $stmt->execute();
        return $stmt;
    }

//    funciona
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (codigo_ficha, estado, fk_programa) 
                  VALUES (:codigo_ficha, :estado, :fk_programa)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':codigo_ficha', $this->codigo_ficha);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_programa', $this->fk_programa);

        return $stmt->execute();
    }

// funciona
    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET codigo_ficha = :codigo_ficha, estado = :estado,  fk_programa = :fk_programa
                  WHERE id_ficha = :id_ficha";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':codigo_ficha', $this->codigo_ficha);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_programa', $this->fk_programa);
        $stmt->bindParam(':id_ficha', $id);

        return $stmt->execute();
    }
// funciona
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_ficha = :id_ficha";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_ficha', $id);
        return $stmt->execute();
    }


    // funciona
    public function patch($id){
        $query = "UPDATE " . $this->table_name . " 
                  SET estado = NOT estado 
                  WHERE id_ficha = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
