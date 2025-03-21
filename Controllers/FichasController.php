<?php
require_once('Config/Database.php');
require_once('Models/Fichas.php');

class FichasController
{
    private $db;
    private $fichas;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->fichas = new Fichas($this->db);
    }

    public function getAll()
    {
        $stmt = $this->fichas->getAll();
        $fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'fichas' => $fichas
        ]);
    }

    public function getById($id_ficha)
    {
        $stmt = $this->fichas->getById($id_ficha);
        $ficha = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ficha) {
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Ficha no encontrada'
            ]);
        } else {
            echo json_encode([
                'Estatus' => 'Code 200',
                'ficha' => $ficha
            ]);
        }
    }

    public function create()
    {
        $postData = json_decode(file_get_contents("php://input"));

        $this->fichas->codigo_ficha = $postData->codigo_ficha;
        $this->fichas->estado = $postData->estado;
        $this->fichas->fk_programa = $postData->fk_programa;

        $created = $this->fichas->create();

        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id_ficha)
    {
        $putData = json_decode(file_get_contents("php://input"));

        $this->fichas->codigo_ficha = $putData->codigo_ficha;
        $this->fichas->estado = $putData->estado;
        $this->fichas->fk_programa = $putData->fk_programa;

        $updated = $this->fichas->update($id_ficha);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id_ficha)
    {
        $deleted = $this->fichas->delete($id_ficha);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id_ficha)
    {
        $patched = $this->fichas->patch($id_ficha);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
