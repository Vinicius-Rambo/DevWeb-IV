<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/src/controller/ProdutoController.php';

$controller = new ProdutoController();
$metodo = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if($metodo === 'GET'){
    if($id !== null && $id > 0){
        $controller->buscarPorId($id);
    }else{
        $controller->listar();
    }
}
else if($metodo === 'POST'){
    $produto = $controller->criar();

    if($produto !== null){
        echo json_encode([
            "mensagem" => "Produto cadastrado com sucesso!",
            "dados" => ProdutoResponseDTO::render($produto)
        ]);
    }
}
else if($metodo === 'PUT'){
    if($id === null || $id <= 0){
        http_response_code(400);
        echo json_encode(["erro" => "Informe um id valido"]);
    }else{
        $controller->alterar($id);
    }
}
else if($metodo === 'DELETE'){
    if($id === null || $id <= 0){
        http_response_code(400);
        echo json_encode(["erro" => "Informe um id valido"]);
    }else{
        $controller->excluir($id);
    }
}
else{
    http_response_code(405);
    echo json_encode(["erro" => "Metodo não permitido"]);
}
