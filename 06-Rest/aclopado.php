<?php

class BancoDados{
    public function salvar($nome){
        return "Produto '{$nome}' salvo com sucesso";
    }
}

class ProdutoController{
    public function criar($nome){
        $banco = new BancoDados();
        return $banco->salvar($nome);
    }
}

$controller = new ProdutoController();
echo $controller->criar("Teclado");