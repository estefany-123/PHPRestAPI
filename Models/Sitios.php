<?php
class Sitios
{
    private $conn;
    private $table_name = "sitios";

    public $id_sitio;
    public $nombre;
    public $persona_encargada;
    public $ubicacion;
    public $estado;
    public $created_at;
    public $updated_at;
    public $fk_tipo_sitio;
    public $fk_area;

    public function __construct($db)
    {
        $this->conn = $db;
    }

//    funciona
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

//  funciona
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_sitio = :id_sitio";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sitio', $id);
        $stmt->execute();
        return $stmt;
    }

    // funciona
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre, persona_encargada, ubicacion, estado,  fk_tipo_sitio, fk_area) 
                  VALUES (:nombre, :persona_encargada, :ubicacion, :estado,  :fk_tipo_sitio, :fk_area)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':persona_encargada', $this->persona_encargada);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_tipo_sitio', $this->fk_tipo_sitio);
        $stmt->bindParam(':fk_area', $this->fk_area);

        return $stmt->execute();
    }

// funciona
    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, persona_encargada = :persona_encargada, ubicacion = :ubicacion, 
                      estado = :estado, 
                      fk_tipo_sitio = :fk_tipo_sitio, fk_area = :fk_area
                  WHERE id_sitio = :id_sitio";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':persona_encargada', $this->persona_encargada);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':fk_tipo_sitio', $this->fk_tipo_sitio);
        $stmt->bindParam(':fk_area', $this->fk_area);
        $stmt->bindParam(':id_sitio', $id);

        return $stmt->execute();
    }

// funciona
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_sitio = :id_sitio";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sitio', $id);
        return $stmt->execute();
    }

// funciona
    public function patch($id){
        $query = "UPDATE " . $this->table_name . " 
                  SET estado = NOT estado 
                  WHERE id_sitio = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
