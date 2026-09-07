<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../DTOs/ProdutoCreateDTO.php';
require_once __DIR__ . '/../DTOs/ProdutoUpdateDTO.php';

class ProdutoModel{
    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function criar(ProdutoCreateDTO $dto): int{
        $sql = "INSERT INTO produtos (nome, preco, estoque)
                VALUES (:nome, :preco, :estoque)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dto->nome);
        $stmt->bindValue(':preco', $dto->preco);
        $stmt->bindValue(':estoque', $dto->estoque);
        $stmt->execute();

        return (int)$this->db->lastInsertId();
    }

    public function buscarPorId(int $id): ?array{
        $sql = "SELECT * FROM produtos WHERE id = :id AND ativo = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $produto = $stmt->fetch();
        return $produto ?: null;
    }

    # - - - 

    public function listarTodos(): array{
        $sql = "SELECT * FROM produtos WHERE ativo = 1 ORDER BY id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function alterar(int $id, ProdutoUpdateDTO $dto): bool{
        $sql = "UPDATE produtos SET nome = :nome, preco = :preco, estoque = :estoque WHERE id = :id AND ativo = 1";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome', $dto->nome);
        $stmt->bindValue(':preco', $dto->preco);
        $stmt->bindValue(':estoque', $dto->estoque);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluir(int $id): bool{
        $sql = "UPDATE produtos SET ativo = 0 WHERE id = :id AND ativo = 1"; #Produtos não são verdadeiramente excluidos, apenas deixam de ser ativos.
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute() && $stmt->rowCount() > 0;
    }
}
