<?php
class Pessoa implements JsonSerializable{
    private string $nome;
    private int $idade;
    private float $salario;
    private DateTime $inscricao;
    
    public function __construct(string $nome, int $idade, float $salario, DateTime $inscricao){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->salario = $salario;
        $this->inscricao = $inscricao;
        
    }

    public function jsonSerialize(){
        return [
            "nome" => $this->nome,
            "idade" => $this->idade,
            "inscricao" => $this->inscricao->format('d/m/Y')
        ];
    }
}

$objeto = new Pessoa("Anacléto", 26, 1500, new DateTime());
$dadosSerializados = json_encode($objeto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $dadosSerializados;

file_put_contents("pessoa.json", $dadosSerializados);
