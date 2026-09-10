<?php
require_once __DIR__ .'/Infra/ConexaoBanco.php';
require_once __DIR__ . 'Service/ProdutoService.php';
require_once __DIR__ . '/Controller/ProdutoController.php';

$dadosPost = json_decode(file_get_contents('php://input'), true);

$banco = new ConexaoBanco(); //Conexão tardia.
$produtoService = new ProdutoService($banco); 
$produtoControlle = new ProdutoController($produtoService);

$controller->criar($dadosPost);








?>