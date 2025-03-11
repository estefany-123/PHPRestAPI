<?php
require_once('Config/Database.php');
require_once('Models/ProgramasFormacion.php');

class ProgramasFormacionController
{
    private $db;
    private $programas;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->programas = new ProgramasFormacion($this->db);
    }

    public function getAll()
    {
        $stmt = $this->programas->getAll();
        $programas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'programas' => $programas
        ]);
    }

    public function getById($id_programa)
    {
        $stmt = $this->programas->getById($id_programa);
        $programa = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$programa) {
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Programa no encontrado'
            ]);
        } else {
            echo json_encode([
                'Estatus' => 'Code 200',
                'programa' => $programa
            ]);
        }
    }

    public function create()
    {
        $postData = json_decode(file_get_contents("php://input"));

        $this->programas->nombre = $postData->nombre;
        $this->programas->estado = $postData->estado;
        $this->programas->created_at = $postData->created_at;
        $this->programas->updated_at = $postData->updated_at;
        $this->programas->fk_area = $postData->fk_area;

        $created = $this->programas->create();

        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id_programa)
    {
        $putData = json_decode(file_get_contents("php://input"));

        $this->programas->nombre = $putData->nombre;
        $this->programas->estado = $putData->estado;
        $this->programas->created_at = $putData->created_at;
        $this->programas->updated_at = $putData->updated_at;
        $this->programas->fk_area = $putData->fk_area;

        $updated = $this->programas->update($id_programa);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id_programa)
    {
        $deleted = $this->programas->delete($id_programa);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }
}
