<?php
require_once('Config/Database.php');
require_once('Models/SolicitudModel.php');

class SolicitudController
{
    private $db;
    private $solicitud;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->solicitud = new SolicitudModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->solicitud->getAll();
        $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'solicitudes' => $solicitudes
        ]);
    }

    public function getById($id){
        $stmt = $this->solicitud->getById($id);
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$solicitud){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'User not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'solicitud' => $solicitud
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->solicitud->descripcion = $postData->descripcion;
        $this->solicitud->cantidad = $postData->cantidad;
        $this->solicitud->aceptada = $postData->aceptada;
        $this->solicitud->pendiente = $postData->pendiente;
        $this->solicitud->rechazada = $postData->rechazada;
        $this->solicitud->fk_usuario = $postData->fk_usuario;
        $this->solicitud->fk_elemento = $postData->fk_elemento;

        $created = $this->solicitud->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->solicitud->descripcion = $putData->descripcion;
        $this->solicitud->cantidad = $putData->cantidad;
        $this->solicitud->aceptada = $putData->aceptada;
        $this->solicitud->pendiente = $putData->pendiente;
        $this->solicitud->rechazada = $putData->rechazada;
        $this->solicitud->fk_usuario = $putData->fk_usuario;
        $this->solicitud->fk_elemento = $putData->fk_elemento;

        $updated = $this->solicitud->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->solicitud->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->solicitud->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
