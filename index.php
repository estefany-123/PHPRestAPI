<?php
// Encabezados
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Content-Type: application/json; charset=UTF-8");

// Obtiene la URL de la solicitud
$request = explode("/", trim($_SERVER['REQUEST_URI']));
$method = $_SERVER["REQUEST_METHOD"];
$table = ucfirst(strtolower($request[2]))."Controller";

// Carga el archivo del controlador correspondiente
$controllerFile = __DIR__ . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . $table . ".php";

// Verifica si el archivo del controlador existe
if(file_exists($controllerFile)) {
    require_once $controllerFile;

    $tableController = new $table();

    switch ($method) {
        case 'GET':
            if(isset($request[3]) && !empty($request[3]) ) {
                $tableController->getById($request[3]);
            }
            else {
                $tableController->getAll();
            }
            break;

        case 'POST':
            $tableController->create();
            break;

        case 'PUT':
            $tableController->update($request[3]);
            break;

        case 'DELETE':
            $tableController->delete($request[3]);
            break;

        default:
            echo json_encode(["message" => "Metodo no permitido"]);
    }
}
else {
    echo json_encode(["message" => "Recurso no permitido"]);
}
