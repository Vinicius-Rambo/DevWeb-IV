<?php
class ProdutoDTO {
    public int $id;
    public string $nome;
    public string $preco;

    public function __construct(int $id, string $nome, string $preco) {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        // A SENHA NÃO ENTRA AQUI DE JEITO NENHUM!
    }
    public function toArray(): array {
        return [
            'id'    => $this->id,
            'nome'  => $this->nome,
            'preco' => $this->preco
        ];
    }
}