<?php
require_once __DIR__ .'/../../config/Database.php';

class ProdutoModel{
    private PDO $db;
    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function criar(ProdutoCreateDTO $dto):int{
        $sql= "insert into produtos(nome, preco, estoque) values (:nome, :preco, :estoque)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dto->nome); 
        $stmt->bindValue(':preco', $dto->preco); 
        $stmt->bindValue(':estoque', $dto->estoque); 

        $stmt->execute();
        return (int) $this->db->lastInsertId();
    }

    public function buscarPorId(int $id):?array{ //Operador ternario incurtado
        $sql= "select * from produtos where id = :id AND ativo = 1";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindValue(":id", $id,PDO::PARAM_INPUT_OUTPUT);
        $stmt->execute();
        $produto = $stmt->fetch();
        return $produto ?: null; //Ternario incurtado.

        return "";
    }
}