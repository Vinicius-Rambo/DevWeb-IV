<?php
$banco = new ConexaoBanco();
$produtoService = new ProdutoService($banco);
$controller = new ProdutoController($produtoService);

echo $controller->criar($dadosPost);