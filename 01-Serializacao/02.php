<?php 

class Serializadora{
    public $nome;
    public $idade;
    public $profissao;

    public function __construct(string $nome, int $idade, string $profissao){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
    }
}

$objeto = new Serializadora("Anacleto", 35, "professor");
$objetoSerializado = serialize($objeto);

echo "<h4> Objeto serializado </h4>";
echo $objetoSerializado;


$dadosRecuperados = unserialize($objetoSerializado);
echo "<h4> dadosRecuperados </h4>";
var_dump($dadosRecuperados); 