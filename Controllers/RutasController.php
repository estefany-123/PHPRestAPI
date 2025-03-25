<?php

require_once('Config/Database.php');
require_once('Models/RutasModel.php');


class RutasController
{
    private $db;
    private $ruta;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->ruta = new RutasModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->ruta->getAll();
        $rutas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'rutas' => $rutas
        ]);
    }

    public function getById($id){
        $stmt = $this->ruta->getById($id);
        $ruta = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$ruta){
            header("HTTP/1.1 404 Not Found");
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'ruta not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'ruta' => $ruta
            ]);
        }
    }


    public function create(){

        $postData = json_decode(file_get_contents("php://input"));

        
        $this->ruta->descripcion = $postData->descripcion;
        $this->ruta->url_destino = $postData->url_destino;
        $this->ruta->estado = $postData->estado;
        $this->ruta->fk_modulo = $postData->fk_modulo;

        $created = $this->ruta->create();

        if($created){
            echo json_encode([
                'Estatus' => 'Code 201',
                'message' => 'ruta created successfully'
            ]);
        }
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

         $this->ruta->descripcion = $putData->descripcion;
        $this->ruta->url_destino = $putData->url_destino;

        $updated = $this->ruta->update($id);

        if($updated){
            echo json_encode([
                'Estatus' => 'Code 200',
                'message' => 'ruta updated successfully'
            ]);
        }
    }

    public function patch($id){
        $patched = $this->ruta->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
    
}

?>