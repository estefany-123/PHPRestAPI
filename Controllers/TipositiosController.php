<?php
require_once('Config/Database.php');
require_once('Models/TipositiosModel.php');

class TipositiosController
{
    private $db;
    private $categoria;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->tipositio = new TipositiosModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->tipositio->getAll();
        $tipositios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'tipositios' => $tipositios
        ]);
    }

    public function getById($id){
        $stmt = $this->tipositio->getById($id);
        $tipositio = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$tipositio){
            header("HTTP/1.1 404 Not Found");
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Tipositio not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'tipositio' => $tipositio
            ]);
        }
    }

    public function create(){

        $postData = json_decode(file_get_contents("php://input"));

        $this->tipositio->nombre = $postData->nombre;

        $created = $this->tipositio->create();

        if($created){
            echo json_encode([
                'Estatus' => 'Code 201',
                'message' => 'Tipositio created successfully'
            ]);
        }
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->tipositio->nombre = $putData->nombre;

        $updated = $this->tipositio->update($id);

        if($updated){
            echo json_encode([
                'Estatus' => 'Code 200',
                'message' => 'Tipositio updated successfully'
            ]);
        }
    }

    public function delete($id){
        $deleted = $this->tipositio->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->tipositio->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }

}