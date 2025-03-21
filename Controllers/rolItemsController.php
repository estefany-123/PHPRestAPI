<?php
require_once ('Config/Database.php');
require_once ('Models/rolItems.php');

class rolItemsController
{
    private $db;
    private $rolItems;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->rolItems = new rolItems($this->db);
    }

    public function getAll()
    {
        $stmt = $this->rolItems->getAll();
        $rolItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'rolItems' => $rolItems
        ]);
    }

    public function getById($id)
    {
        $stmt = $this->rolItems->getById($id);
        $rolItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$id) {
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Área no encontrada'
            ]);
        } else {
            echo json_encode([
                'Estatus' => 'Code 200',
                'rolItem' => $rolItem
            ]);
        }
    }

    public function create()
    {
        $postData = json_decode(file_get_contents("php://input"));

        $this->rolItems->item_id = $postData->item_id;
        $this->rolItems->estado = $postData->estado;
        $this->rolItems->fk_rol = $postData->fk_rol;

        $created = $this->rolItems->create();

        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id)
    {
        $putData = json_decode(file_get_contents("php://input"));

        $this->rolItems->item_id = $putData->item_id;
        $this->rolItems->estado = $putData->estado;
        $this->rolItems->fk_rol = $putData->fk_rol;


        $updated = $this->rolItems->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id)
    {
        $deleted = $this->rolItems->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id)
    {
        $patched = $this->rolItems->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
