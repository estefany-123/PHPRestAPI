<?php
require_once('Config/Database.php');
require_once('Models/rutasRolItems.php');

class rutasRolItemsController
{
    private $db;
    private $rutasRolItems;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->rutasRolItems = new rutasRolItems($this->db);
    }

    public function getAll()
    {
        $stmt = $this->rutasRolItems->getAll();
        $rol_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'usersFicha' => $rol_items
        ]);
    }

    public function getById($id_ruta_rol){
        $stmt = $this->rutasRolItems->getById($id_ruta_rol);
        $rol_items = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$rol_items){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'User not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'rol_items' => $rol_items
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->rutasRolItems->fk_ruta = $postData->fk_ruta;
        $this->rutasRolItems->fk_rol_item = $postData->fk_rol_item;
        $created = $this->rutasRolItems->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id_ruta_rol){
        $putData = json_decode(file_get_contents("php://input"));

        $this->rutasRolItems->fk_ruta = $putData->fk_ruta;
        $this->rutasRolItems->fk_rol_item = $putData->fk_rol_item;

        $updated = $this->rutasRolItems->update($id_ruta_rol);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id_ruta_rol){
        $deleted = $this->rutasRolItems->delete($id_ruta_rol);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

      



}
