<?php

require_once('Config/Database.php');
require_once('Models/ModulosModel.php');


class ModulosController
{
    private $db;
    private $modulo;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->modulo = new ModulosModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->modulo->getAll();
        $modulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'modulos' => $modulos
        ]);
    }

    public function getById($nombre){
        $stmt = $this->modulo->getById($nombre);
        $modulo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$modulo){
            header("HTTP/1.1 404 Not Found");
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Modulo not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'modulo' => $modulo
            ]);
        }
    }


    public function create(){

        $postData = json_decode(file_get_contents("php://input"));

        $this->modulo->nombre = $postData->nombre;
        $this->modulo->descripcion = $postData->descripcion;
        $this->modulo->estado = $postData->estado;

        $created = $this->modulo->create();

        if($created){
            echo json_encode([
                'Estatus' => 'Code 201',
                'message' => 'modulo created successfully'
            ]);
        }
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->modulo->nombre = $putData->nombre;
        $this->modulo->descripcion = $putData->descripcion;

        $updated = $this->modulo->update($id);

        if($updated){
            echo json_encode([
                'Estatus' => 'Code 200',
                'message' => 'Modulo updated successfully'
            ]);
        }
    }

    public function patch($id){
        $patched = $this->modulo->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
    
}

?>