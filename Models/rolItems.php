<?php

class rolItems
{
    private $connect;
    private $table = 'rol_items';

    public $id;
    public $item_id;
    public $estado;
    public $fk_rol;


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
    public function getById($id){
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }


    // funciona
    public function create(){
        $query = "INSERT INTO " . $this->table . " (item_id, estado,  fk_rol) 
                  VALUES (?, ?, ?)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->item_id);
        $stmt->bindParam(2, $this->estado);
        $stmt->bindParam(3, $this->fk_rol, PDO::PARAM_INT);
        return $stmt->execute();
    }

// funciona
    public function update($id){
        $query = "UPDATE " . $this->table . " 
                  SET item_id = ?, estado = ?,  fk_rol = ? 
                  WHERE id = ?";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->item_id);
        $stmt->bindParam(2, $this->estado);
        $stmt->bindParam(3, $this->fk_rol, PDO::PARAM_INT);
        $stmt->bindParam(4, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    // funciona
    public function delete($id){
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

// funciona
    public function patch($id){
        $query = "UPDATE " . $this->table . " 
                  SET estado = NOT estado 
                  WHERE id = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
