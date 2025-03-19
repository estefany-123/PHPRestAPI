<?php
require_once('Config/Database.php');
require_once('Models/ElementoModel.php');

class ElementoController
{
    private $db;
    private $elemento;

    public function __construct()
    {
        $database = new Database();

        $this->db = $database->getConnection();
        $this->elemento = new ElementoModel($this->db);
    }

    public function getAll()
    {
        $stmt = $this->elemento->getAll();
        $elementos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'Estatus' => 'Code 200',
            'elementos' => $elementos
        ]);
    }

    public function getById($id){
        $stmt = $this->elemento->getById($id);
        $elemento = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$elemento){
            echo json_encode([
                'Estatus' => 'Code 404',
                'message' => 'Element not found'
            ]);
        }
        else{
            echo json_encode([
                'Estatus' => 'Code 200',
                'elemento' => $elemento
            ]);
        }
    }

    public function create(){
        $postData = json_decode(file_get_contents("php://input"));

        $this->elemento->nombre = $postData->nombre;
        $this->elemento->descripcion = $postData->descripcion;
        $this->elemento->valor = $postData->valor;
        $this->elemento->consumible = $postData->consumible;
        $this->elemento->no_consumible = $postData->no_consumible;
        $this->elemento->estado = $postData->estado;
        $this->elemento->imagen_elemento = $postData->imagen_elemento;
        $this->elemento->fk_unidad_medida = $postData->fk_unidad_medida;
        $this->elemento->fk_categoria = $postData->fk_categoria;
        $this->elemento->fk_caracteristica = $postData->fk_caracteristica;

        $created = $this->elemento->create();
        echo json_encode([
            'Estatus' => 'Code 201',
            'created' => $created
        ]);
    }

    public function update($id){
        $putData = json_decode(file_get_contents("php://input"));

        $this->elemento->nombre = $putData->nombre;
        $this->elemento->descripcion = $putData->descripcion;
        $this->elemento->valor = $putData->valor;
        $this->elemento->consumible = $putData->consumible;
        $this->elemento->no_consumible = $putData->no_consumible;
        $this->elemento->estado = $putData->estado;
        $this->elemento->imagen_elemento = $putData->imagen_elemento;
        $this->elemento->fk_unidad_medida = $putData->fk_unidad_medida;
        $this->elemento->fk_categoria = $putData->fk_categoria;
        $this->elemento->fk_caracteristica = $putData->fk_caracteristica;

        $updated = $this->elemento->update($id);

        echo json_encode([
            'Estatus' => 'Code 200',
            'updated' => $updated
        ]);
    }

    public function delete($id){
        $deleted = $this->elemento->delete($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'deleted' => $deleted
        ]);
    }

    public function patch($id){
        $patched = $this->elemento->patch($id);
        echo json_encode([
            'Estatus' => 'Code 200',
            'patched' => $patched
        ]);
    }
}
