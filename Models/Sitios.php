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

    // Obtener todos los sitios
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un sitio por ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_sitio = :id_sitio";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sitio', $id);
        $stmt->execute();
        return $stmt;
    }

    // Crear un nuevo sitio
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre, persona_encargada, ubicacion, estado, created_at, updated_at, fk_tipo_sitio, fk_area) 
                  VALUES (:nombre, :persona_encargada, :ubicacion, :estado, :created_at, :updated_at, :fk_tipo_sitio, :fk_area)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':persona_encargada', $this->persona_encargada);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':fk_tipo_sitio', $this->fk_tipo_sitio);
        $stmt->bindParam(':fk_area', $this->fk_area);

        return $stmt->execute();
    }

    // Actualizar un sitio
    public function update($id)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, persona_encargada = :persona_encargada, ubicacion = :ubicacion, 
                      estado = :estado, created_at = :created_at, updated_at = :updated_at, 
                      fk_tipo_sitio = :fk_tipo_sitio, fk_area = :fk_area
                  WHERE id_sitio = :id_sitio";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':persona_encargada', $this->persona_encargada);
        $stmt->bindParam(':ubicacion', $this->ubicacion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':fk_tipo_sitio', $this->fk_tipo_sitio);
        $stmt->bindParam(':fk_area', $this->fk_area);
        $stmt->bindParam(':id_sitio', $id);

        return $stmt->execute();
    }

    // Eliminar un sitio
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_sitio = :id_sitio";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sitio', $id);
        return $stmt->execute();
    }
}
