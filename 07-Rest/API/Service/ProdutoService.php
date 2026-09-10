<?php

class ProdutoService{
    private $banco;

    public function __construct(ConexaoBanco $banco){ //O Construtor recebe o banco.
        $this->banco = $banco;
    }

    public function salvar($dados){
        if(empty($dados["nome"])){ //Se a variavel NÃO tiver conteudo.
            throw new Exception("O campo nome é obrigatorio");
        }

        if(!isset($dados['preco']) || $dados['preco'] <= 0){ //Se a variavel não existir. 
            throw new Exception("O preço deve ser maior que zero");
        }

        return $this->banco->salvar($dados); //Retorna do banco o salvamento de dados, se passar pelas validações. 

    }
}



?>