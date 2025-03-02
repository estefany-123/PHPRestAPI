<?php
require_once('Config/Database.php');
require_once('Models/MunicipiosModel.php');

class MunicipiosController
{
    private $db;
    private $municipio;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->municipio = new MunicipiosModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->municipio->getAll();
        $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'municipios' => $municipios
        ]);
    }

    public function getById($id){
        $stmt = $this->municipio->getById($id);
        $municipio = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$municipio){
            header("HTTP/1.1 404 Not Found");
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Municipio not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'municipio' => $municipio
            ]);
        }
    }

    public function create(){

        $postData = json_decode(file_get_contents("php://input"));

        $this->municipio->nombre = $postData->nombre;
        $this->municipio->departamento = $postData->departamento;

        $created = $this->municipio->create();

        if($created){
            echo json_encode([
                'Estatus' => 'Code 201',
                'message' => 'Municipio created successfully'
            ]);
        }
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->municipio->nombre = $putData->nombre;
        $this->municipio->departamento = $putData->departamento;

        $updated = $this->municipio->update($id);

        if($updated){
            echo json_encode([
                'Estatus' => 'Code 200',
                'message' => 'Municipio updated successfully'
            ]);
        }
    }

    public function delete($id){
        $deleted = $this->municipio->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->municipio->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }

}