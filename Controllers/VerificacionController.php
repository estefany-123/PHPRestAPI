<?php
require_once('Config/Database.php');
require_once('Models/VerificacionModel.php');

class VerificacionController
{
    private $db;
    private $verificacion;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->verificacion = new VerificacionModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->verificacion->getAll();
        $verificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'verificaciones' => $verificaciones
        ]);
    }

    public function getById($id){
        $stmt = $this->verificacion->getById($id);
        $verificacion = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$verificacion){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Verificacion not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'verificacion' => $verificacion
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->verificacion->persona_encargada = $postData->persona_encargada;
        $this->verificacion->persona_asignada = $postData->persona_asignada;
        $this->verificacion->hora_ingreso = $postData->hora_ingreso;
        $this->verificacion->hora_fin = $postData->hora_fin;
        $this->verificacion->fk_inventario = $postData->fk_inventario;

        $created = $this->verificacion->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->verificacion->persona_encargada = $putData->persona_encargada;
        $this->verificacion->persona_asignada = $putData->persona_asignada;
        $this->verificacion->hora_ingreso = $putData->hora_ingreso;
        $this->verificacion->hora_fin = $putData->hora_fin;
        $this->verificacion->fk_inventario = $putData->fk_inventario;

        $updated = $this->verificacion->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->verificacion->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }
}
