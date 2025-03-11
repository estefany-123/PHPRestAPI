<?php
require_once ('Config/Database.php');
require_once ('Models/Areas.php');

class AreasController
{
    private $db;
    private $areas;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->areas = new Areas($this->db);
    }

    public function getAll()
    {
        $stmt = $this->areas->getAll();
        $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'areas' => $areas
        ]);
    }

    public function getById($id_area)
    {
        $stmt = $this->areas->getById($id_area);
        $area = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$area) {
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Área no encontrada'
            ]);
        } else {
            echo json_encode([
                'Estatus' => 'Code 200',
                'area' => $area
            ]);
        }
    }

    public function create()
    {
        $postData = json_decode(file_get_contents("php://input"));

        $this->areas->nombre = $postData->nombre;
        $this->areas->persona_encargada = $postData->persona_encargada;
        $this->areas->estado = $postData->estado;
        $this->areas->fk_sede = $postData->fk_sede;

        $created = $this->areas->create();

        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id_area)
    {
        $putData = json_decode(file_get_contents("php://input"));

        $this->areas->nombre = $putData->nombre;
        $this->areas->persona_encargada = $putData->persona_encargada;
        $this->areas->estado = $putData->estado;

        $this->areas->fk_sede = $putData->fk_sede;

        $updated = $this->areas->update($id_area);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id_area)
    {
        $deleted = $this->areas->delete($id_area);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id_area)
    {
        $patched = $this->areas->patch($id_area);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
