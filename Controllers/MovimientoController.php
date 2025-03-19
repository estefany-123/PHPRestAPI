<?php
require_once('Config/Database.php');
require_once('Models/MovimientoModel.php');

class MovimientoController
{
    private $db;
    private $movimiento;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->movimiento = new MovimientoModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->movimiento->getAll();
        $movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'movimientos' => $movimientos
        ]);
    }

    public function getById($id){
        $stmt = $this->movimiento->getById($id);
        $movimiento = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$movimiento){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Motion not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'movimiento' => $movimiento
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->movimiento->descripcion = $postData->descripcion;
        $this->movimiento->cantidad = $postData->cantidad;
        $this->movimiento->hora_ingreso = $postData->hora_ingreso;
        $this->movimiento->hora_salida = $postData->hora_salida;
        $this->movimiento->aceptado = $postData->aceptado;
        $this->movimiento->en_proceso = $postData->en_proceso;
        $this->movimiento->cancelado = $postData->cancelado;
        $this->movimiento->devolutivo = $postData->devolutivo;
        $this->movimiento->no_devolutivo = $postData->no_devolutivo;
        $this->movimiento->fk_usuario = $postData->fk_usuario;
        $this->movimiento->fk_tipo_movimiento = $postData->fk_tipo_movimiento;
        $this->movimiento->fk_sitio = $postData->fk_sitio;
        $this->movimiento->fk_inventario = $postData->fk_inventario;

        $created = $this->movimiento->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->movimiento->descripcion = $putData->descripcion;
        $this->movimiento->cantidad = $putData->cantidad;
        $this->movimiento->hora_ingreso = $putData->hora_ingreso;
        $this->movimiento->hora_salida = $putData->hora_salida;
        $this->movimiento->aceptado = $putData->aceptado;
        $this->movimiento->en_proceso = $putData->en_proceso;
        $this->movimiento->cancelado = $putData->cancelado;
        $this->movimiento->devolutivo = $putData->devolutivo;
        $this->movimiento->no_devolutivo = $putData->no_devolutivo;
        $this->movimiento->fk_usuario = $putData->fk_usuario;
        $this->movimiento->fk_tipo_movimiento = $putData->fk_tipo_movimiento;
        $this->movimiento->fk_sitio = $putData->fk_sitio;
        $this->movimiento->fk_inventario = $putData->fk_inventario;

        $updated = $this->movimiento->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->movimiento->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->movimiento->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
