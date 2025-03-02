<?php
require_once('Config/Database.php');
require_once('Models/CategoriasModel.php');

class CategoriasController
{
    private $db;
    private $categoria;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->categoria = new CategoriasModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->categoria->getAll();
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'categorias' => $categorias
        ]);
    }

    public function getById($id){
        $stmt = $this->categoria->getById($id);
        $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$categoria){
            header("HTTP/1.1 404 Not Found");
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Categoria not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'categoria' => $categoria
            ]);
        }
    }

    public function create(){

        $postData = json_decode(file_get_contents("php://input"));

        $this->categoria->nombre = $postData->nombre;

        $created = $this->categoria->create();

        if($created){
            echo json_encode([
                'Estatus' => 'Code 201',
                'message' => 'Categoria created successfully'
            ]);
        }
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->categoria->nombre = $putData->nombre;

        $updated = $this->categoria->update($id);

        if($updated){
            echo json_encode([
                'Estatus' => 'Code 200',
                'message' => 'Centro updated successfully'
            ]);
        }
    }

    public function delete($id){
        $deleted = $this->categoria->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->categoria->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }

}