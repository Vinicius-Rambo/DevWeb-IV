<?php
class ConexaoBanco{
    private $pdo = null;
    public function getConexao(){
        if($this->pdo == null){
            $host = "localhost";
            $usuario = "root";
            $senha = "bancodedados";
            $banco = "sitema_teste";

            $this->pdo = new PDO(
                "mysql:host={$host};
                dbname={$banco}", 
                $usuario,
                $senha);
            
        }
        return $this->pdo;
    }

    public function salvar($dados){
        $sql="insert into produtos (nome,preco) values (:nome, :preco)";
        $stmt = $this->getConexao()->prepare($sql);
        $stmt->execute([':nome'=>$dados['nome'], ':preco'=>$dados['preco']]);

        return [
            "id" => $stmt->getConexao()->lastInsertId(),
            "nome" => $dados['nome'],
            "preco" => $dados['preco'],
        ];

    }

}                        
    
?>