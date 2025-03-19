<?php
require_once('Config/Database.php');
require_once('Models/UnidadMedidaModel.php');

class UnidadMedidaController
{
    private $db;
    private $unidad;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->unidad = new UnidadMedidaModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->unidad->getAll();
        $unidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'unidades' => $unidades
        ]);
    }

    public function getById($id){
        $stmt = $this->unidad->getById($id);
        $unidad = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$unidad){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Unidad not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'unidad' => $unidad
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->unidad->nombre = $postData->nombre;
        $this->unidad->estado = $postData->estado;

        $created = $this->unidad->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->unidad->nombre = $putData->nombre;
        $this->unidad->estado = $putData->estado;

        $updated = $this->unidad->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->unidad->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->unidad->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
