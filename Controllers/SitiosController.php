<?php
require_once('Config/Database.php');
require_once('Models/Sitios.php');

class SitiosController
{
    private $db;
    private $sitios;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sitios = new Sitios($this->db);
    }

    public function getAll()
    {
        $stmt = $this->sitios->getAll();
        $sitios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'sitios' => $sitios
        ]);
    }

    public function getById($id_sitio)
    {
        $stmt = $this->sitios->getById($id_sitio);
        $sitio = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$sitio) {
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Sitio no encontrado'
            ]);
        } else {
            echo json_encode([
                'Estatus' => 'Code 200',
                'sitio' => $sitio
            ]);
        }
    }

    public function create()
    {
        $postData = json_decode(file_get_contents("php://input"));

        $this->sitios->nombre = $postData->nombre;
        $this->sitios->persona_encargada = $postData->persona_encargada;
        $this->sitios->ubicacion = $postData->ubicacion;
        $this->sitios->estado = $postData->estado;
        $this->sitios->fk_tipo_sitio = $postData->fk_tipo_sitio;
        $this->sitios->fk_area = $postData->fk_area;

        $created = $this->sitios->create();

        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id_sitio)
    {
        $putData = json_decode(file_get_contents("php://input"));

        $this->sitios->nombre = $putData->nombre;
        $this->sitios->persona_encargada = $putData->persona_encargada;
        $this->sitios->ubicacion = $putData->ubicacion;
        $this->sitios->estado = $putData->estado;
        $this->sitios->fk_tipo_sitio = $putData->fk_tipo_sitio;
        $this->sitios->fk_area = $putData->fk_area;

        $updated = $this->sitios->update($id_sitio);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id_sitio)
    {
        $deleted = $this->sitios->delete($id_sitio);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id_sitio)
    {
        $patched = $this->sitios->patch($id_sitio);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
