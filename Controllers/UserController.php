<?php
require_once('Config/Database.php');
require_once('Models/User.php');

class UserController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function getAll()
    {
        $stmt = $this->user->getAll();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'users' => $users
        ]);
    }

    public function getById($id){
        $stmt = $this->user->getById($id);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'User not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'user' => $user
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->user->name = $postData->name;
        $this->user->email = $postData->email;
        $created = $this->user->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->user->name = $putData->name;
        $this->user->email = $putData->email;

        $updated = $this->user->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->user->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }
}
