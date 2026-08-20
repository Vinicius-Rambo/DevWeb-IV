<?php
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/src/Controllers/ProdutoController.php';
$controller = new ProdutoController();
$metodo = $_SERVER['REQUEST_METHOD'];

if($metodo === 'GET'){
    $controller -> listar();
}

else if($metodo === 'POST') {
    $controller -> criar();
}

else{
    http_response_code(405);
    echo json_encode(["erro" => "Metodo não permitido"]);
    
}


?>