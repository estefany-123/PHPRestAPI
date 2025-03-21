<?php

class Areas
{
    private $connect;
    private $table = 'areas';

    public $id_area;
    public $nombre;
    public $persona_encargada;
    public $estado;
    public $fk_sede;

    public function __construct($db){
        $this->connect = $db;
    }
// funciona
    public function getAll(){
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }
// funciona
    public function getById($id_area){
        $query = "SELECT * FROM " . $this->table . " WHERE id_area = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id_area, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
// funciona
    public function create(){
        $query = "INSERT INTO " . $this->table . " (nombre, persona_encargada, estado, fk_sede) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->persona_encargada);
        $stmt->bindParam(3, $this->estado);
        $stmt->bindParam(4, $this->fk_sede, PDO::PARAM_INT);
        return $stmt->execute();
    }
// funciona
    public function update($id_area){
        $query = "UPDATE " . $this->table . " 
                  SET nombre = ?, persona_encargada = ?, estado = ?, fk_sede = ? 
                  WHERE id_area = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->nombre);
        $stmt->bindParam(2, $this->persona_encargada);
        $stmt->bindParam(3, $this->estado);
        $stmt->bindParam(4, $this->fk_sede, PDO::PARAM_INT);
        $stmt->bindParam(5, $id_area, PDO::PARAM_INT);

        return $stmt->execute();
    }
// funciona
    public function delete($id_area){
        $query = "DELETE FROM " . $this->table . " WHERE id_area = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id_area, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // funciona
    public function patch($id_area){
        $query = "UPDATE " . $this->table . " 
                  SET estado = NOT estado 
                  WHERE id_area = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id_area, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
