<?php

class BancoDados{
    public function salvar($nome){
        return "Produto '{$nome}' salvo com sucesso";
    }
}

class ProdutoController{
    private $banco;

    public function __construct($banco){
        $this->banco = $banco;
    }

    public function criar($nome){
        return $this->banco->salvar($nome);
    }
}

$banco = new BancoDados();
$controller = new ProdutoController($banco);
echo $controller->criar("Teclado");