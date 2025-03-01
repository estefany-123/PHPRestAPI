<?php
require_once('Config/Database.php');
require_once('Models/UsuariosModel.php');

class UsuariosController
{
    private $db;
    private $usuario;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->usuario = new UsuariosModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->usuario->getAll();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'usuarios' => $usuarios
        ]);
    }

    public function getById($id){
        $stmt = $this->usuario->getById($id);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$usuario){
            header("HTTP/1.1 404 Not Found");
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'User not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'usuario' => $usuario
            ]);
        }
    }

}