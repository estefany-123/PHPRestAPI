<?php
require_once('Config/Database.php');
require_once('Models/RolModel.php');

class RolController
{
    private $db;
    private $rol;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->rol = new RolModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->rol->getAll();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'roles' => $roles
        ]);
    }

    public function getById($id){
        $stmt = $this->rol->getById($id);
        $rol = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$rol){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'User not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'rol' => $rol
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->rol->nombre = $postData->nombre;
        $this->rol->estado = $postData->estado;


        $created = $this->rol->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->rol->nombre = $putData->nombre;
        $this->rol->estado = $putData->estado;


        $updated = $this->rol->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->rol->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->rol->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
