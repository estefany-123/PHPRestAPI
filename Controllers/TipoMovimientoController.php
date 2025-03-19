<?php
require_once('Config/Database.php');
require_once('Models/TipoMovimientoModel.php');

class TipoMovimientoController
{
    private $db;
    private $tipoMovimiento;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->tipoMovimiento = new TipoMovimientoModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->tipoMovimiento->getAll();
        $tipoMovimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'tipoMovimientos' => $tipoMovimientos
        ]);
    }

    public function getById($id){
        $stmt = $this->tipoMovimiento->getById($id);
        $tipoMovimiento = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$tipoMovimiento){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Tipo Movimiento not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'tipoMovimiento' => $tipoMovimiento
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->tipoMovimiento->nombre = $postData->nombre;
        $this->tipoMovimiento->estado = $postData->estado;


        $created = $this->tipoMovimiento->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->tipoMovimiento->nombre = $putData->nombre;
        $this->tipoMovimiento->estado = $putData->estado;


        $updated = $this->tipoMovimiento->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->tipoMovimiento->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->tipoMovimiento->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
