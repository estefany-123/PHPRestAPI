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

    public function create(){

        $postData = json_decode(file_get_contents("php://input"));

        $hashedPassword = password_hash($postData->password, PASSWORD_BCRYPT);

        $this->usuario->documento = $postData->documento;
        $this->usuario->nombre = $postData->nombre;
        $this->usuario->apellido = $postData->apellido;
        $this->usuario->edad = $postData->edad;
        $this->usuario->telefono = $postData->telefono;
        $this->usuario->correo = $postData->correo;
        $this->usuario->cargo = $postData->cargo;
        $this->usuario->password = $hashedPassword;

        $created = $this->usuario->create();

        if($created){
            echo json_encode([
                'Estatus' => 'Code 201',
                'message' => 'User created successfully'
            ]);
        }
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $hashedPassword = password_hash($putData->password, PASSWORD_BCRYPT);

        $this->usuario->documento = $putData->documento;
        $this->usuario->nombre = $putData->nombre;
        $this->usuario->apellido = $putData->apellido;
        $this->usuario->edad = $putData->edad;
        $this->usuario->telefono = $putData->telefono;
        $this->usuario->correo = $putData->correo;
        $this->usuario->cargo = $putData->cargo;
        $this->usuario->password = $hashedPassword;

        $updated = $this->usuario->update($id);

        if($updated){
            echo json_encode([
                'Estatus' => 'Code 200',
                'message' => 'User updated successfully'
            ]);
        }
    }

    public function delete($id){
        $deleted = $this->usuario->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

}