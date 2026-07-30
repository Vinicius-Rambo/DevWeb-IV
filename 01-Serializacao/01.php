<?php

$vetor = [
    "nome" => "asasadasds",
    "idade" => 21,
    "Profissao" => "professor"
]; 

$dadoSerializados = serialize($vetor);
echo "Dados Serializados <br>";
echo $dadoSerializados . "<hr>";


$dadosRecuperados = unserialize($dadoSerializados);
echo "Dados recuperados <br>";
var_dump($dadosRecuperados);

