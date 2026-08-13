<?php
require_once '../Atividade/ProdutoDTO.php';
class estoqueService {
    private $pdo;
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $preco, $estoque) {
        if (empty($nome) || empty($preco) || empty($estoque)) {
            throw new Exception("Preencha todos os campos!");
        }
        $stmt = $this->pdo->prepare('SELECT id FROM produtos WHERE nome = ?');
        $stmt->execute([$nome]);
        if ($stmt->fetch()) {
            throw new Exception("Este nome já está cadastrado!");
        }
        
        $stmt = $this->pdo->prepare('INSERT INTO produtos (nome, preco, estoque) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $preco, $estoque]);

        return "Produto cadastrado com sucesso!";
    }
    public function cadastrarComDTO($nome, $preco, $estoque): ProdutoDTO {

        if (empty($nome) || empty($preco) || empty($estoque)) {
            throw new Exception("Preencha todos os campos!");
        }
        $stmt = $this->pdo->prepare('SELECT id FROM produtos WHERE nome = ?');
        $stmt->execute([$nome]);
        if ($stmt->fetch()) {
            throw new Exception("Este nome já está cadastrado!");
        }

        $stmt = $this->pdo->prepare('INSERT INTO produtos (nome, preco, estoque) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $preco, $estoque]);
        $idGerado = (int) $this->pdo->lastInsertId();
        return new ProdutoDTO($idGerado, $nome, $preco);
    }
    public function listarTodos(): array {
    $stmt = $this->pdo->query('SELECT id, nome, preco FROM produtos');
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];
        foreach ($produtos as $u) {
            $dtos[] = new UsuarioDTO((int)$u['id'], $u['nome'], $u['preco']);
        }
        return $dtos;
    }

    public function deletar(int $id): bool {
        $stmt = $this->pdo->prepare('SELECT id FROM produtos WHERE id = ?');
        $stmt->execute([$id]);
        if (!$stmt->fetch()) {
            throw new Exception("Produto  não encontrado!");
        }

        $stmt = $this->pdo->prepare('DELETE FROM produtos WHERE id = ?');
        return $stmt->execute([$id]);
    }
}