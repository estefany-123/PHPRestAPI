<?php
require_once('Config/Database.php');
require_once('Models/usuario_ficha.php');

class usuario_fichaController
{
    private $db;
    private $usuarioficha;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->usuarioficha = new usuarioficha($this->db);
    }

    public function getAll()
    {
        $stmt = $this->usuarioficha->getAll();
        $usersFicha = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'usersFicha' => $usersFicha
        ]);
    }

    public function getById($id_usuario_ficha){
        $stmt = $this->usuarioficha->getById($id_usuario_ficha);
        $usersFicha = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$usersFicha){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'User not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'usersFicha' => $usersFicha
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->usuarioficha->fk_usuario = $postData->fk_usuario;
        $this->usuarioficha->fk_ficha = $postData->fk_ficha;
        $created = $this->usuarioficha->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id_usuario_ficha){
        $putData = json_decode(file_get_contents("php://input"));

        $this->usuarioficha->fk_usuario = $putData->fk_usuario;
        $this->usuarioficha->fk_ficha = $putData->fk_ficha;

        $updated = $this->usuarioficha->update($id_usuario_ficha);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id_usuario_ficha){
        $deleted = $this->usuarioficha->delete($id_usuario_ficha);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id_usuario_ficha){
        $patched = $this->usuarioficha->patch($id_usuario_ficha);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
