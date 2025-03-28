<?php

require_once __DIR__.'/vendor/autoload.php';
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Encabezados
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");
header("Content-Type: application/json; charset=UTF-8");

// Obtiene la URL de la solicitud
$request = explode("/", trim($_SERVER['REQUEST_URI']));
$method = $_SERVER["REQUEST_METHOD"];
$table = ucfirst(strtolower($request[2])) . "Controller";

// Carga el archivo del controlador correspondiente
$controllerFile = __DIR__ . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . $table . ".php";

if($table != 'UsuariosController'){
    $headers = getallheaders();
    if(!isset($headers["Authorization"])) {
        header("HTTP/2 401");
        die(json_encode([
            "message" => "Token no proveído"
        ]));
    }
    $authHeader = explode(' ',$headers['Authorization'])[1] ?? null;
    if(is_null($authHeader)){
        header("HTTP/2 401");
        die(json_encode([
            "message" => "No tienes permitido entrar a esta ruta"
        ]));
    }
    $key = 'estefany';
    try{
        $decoded = JWT::decode($authHeader, new Key($key, 'HS256'));
    }
    catch(Exception $error){
        header("HTTP/2 401");
        die(json_encode([
            "message" => "Token invalido"
        ]));
    }
}

// Verifica si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    $tableController = new $table();

    switch ($method) {
        case 'GET':
            if (isset($request[3]) && !empty($request[3])) {
                $tableController->getById($request[3]);
            } else {
                $tableController->getAll();
            }
            break;

        case 'POST':
            if ($request[3] == 'login')  {
                $body = json_decode(file_get_contents('php://input'));
                if(!isset($body->correo) || !isset($body->password)) {
                    header("HTTP/2 400");
                    die(json_encode(["message" => "Credenciales no proveídas"]));
                }
                $tableController->login($body->correo, $body->password);
            } else {
                $tableController->create();
            }
            break;

        case 'PUT':
            $tableController->update($request[3]);
            break;

        case 'DELETE':
            $tableController->delete($request[3]);
            break;

        case 'PATCH':
            $tableController->patch($request[3]);
            break;

        default:
            echo json_encode(["message" => "Metodo no permitido"]);
    }
} else {
    echo json_encode(["message" => "Recurso no permitido"]);
}
