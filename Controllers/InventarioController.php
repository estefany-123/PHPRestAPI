<?php
require_once('Config/Database.php');
require_once('Models/InventarioModel.php');

class InventarioController
{
    private $db;
    private $inventario;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->inventario = new InventarioModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->inventario->getAll();
        $inventarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'inventarios' => $inventarios
        ]);
    }

    public function getById($id){
        $stmt = $this->inventario->getById($id);
        $inventario = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$inventario){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Inventory not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'inventario' => $inventario
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->inventario->stock = $postData->stock;
        $this->inventario->estado = $postData->estado;
        $this->inventario->fk_sitio = $postData->fk_sitio;
        $this->inventario->fk_elemento = $postData->fk_elemento;

        $created = $this->inventario->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->inventario->stock = $putData->stock;
        $this->inventario->estado = $putData->estado;
        $this->inventario->fk_sitio = $putData->fk_sitio;
        $this->inventario->fk_elemento = $putData->fk_elemento;

        $updated = $this->inventario->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->inventario->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->inventario->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
