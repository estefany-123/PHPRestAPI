<?php
require_once('Config/Database.php');
require_once('Models/CentrosModel.php');

class CentrosController
{
    private $db;
    private $centro;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->centro = new CentrosModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->centro->getAll();
        $centros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'centros' => $centros
        ]);
    }

    public function getById($id){
        $stmt = $this->centro->getById($id);
        $centro = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$centro){
            header("HTTP/1.1 404 Not Found");
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Centro not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'centro' => $centro
            ]);
        }
    }

    public function create(){

        $postData = json_decode(file_get_contents("php://input"));

        $this->centro->nombre = $postData->nombre;

        $created = $this->centro->create();

        if($created){
            echo json_encode([
                'Estatus' => 'Code 201',
                'message' => 'Centro created successfully'
            ]);
        }
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->centro->nombre = $putData->nombre;

        $updated = $this->centro->update($id);

        if($updated){
            echo json_encode([
                'Estatus' => 'Code 200',
                'message' => 'Centro updated successfully'
            ]);
        }
    }

    public function delete($id){
        $deleted = $this->centro->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->centro->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }

}