<?php
require_once('Config/Database.php');
require_once('Models/Sedes.php');

class SedesController
{
    private $db;
    private $sedes;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sedes = new Sedes($this->db);
    }

    public function getAll()
    {
        $stmt = $this->sedes->getAll();
        $sedes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'sedes' => $sedes
        ]);
    }

    public function getById($id_sede)
    {
        $stmt = $this->sedes->getById($id_sede);
        $sede = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$sede) {
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Sede no encontrada'
            ]);
        } else {
            echo json_encode([
                'Estatus' => 'Code 200',
                'sede' => $sede
            ]);
        }
    }

    public function create()
    {
        $postData = json_decode(file_get_contents("php://input"));

        $this->sedes->nombre = $postData->nombre;
        $this->sedes->estado = $postData->estado;
        $this->sedes->created_at = $postData->created_at;
        $this->sedes->updated_at = $postData->updated_at;
        $this->sedes->fk_centro = $postData->fk_centro;

        $created = $this->sedes->create();

        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id_sede)
    {
        $putData = json_decode(file_get_contents("php://input"));

        $this->sedes->nombre = $putData->nombre;
        $this->sedes->estado = $putData->estado;
        $this->sedes->created_at = $putData->created_at;
        $this->sedes->updated_at = $putData->updated_at;
        $this->sedes->fk_centro = $putData->fk_centro;

        $updated = $this->sedes->update($id_sede);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id_sede)
    {
        $deleted = $this->sedes->delete($id_sede);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }
}
