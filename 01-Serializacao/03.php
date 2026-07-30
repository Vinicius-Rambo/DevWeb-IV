<?php

$jsonCorrompido  = '{"Nome" : "Asdrubaldo", "Idade" : 21, "Profissao" : "professor';
// $jsonCorrompido  = '{"Nome" : "Asdrubaldo", "Idade" : 21, "Profissao" : "professor"}';

try{
    $dadosRecuperados = json_decode($jsonCorrompido, true, 512, JSON_THROW_ON_ERROR);
    $dadosRecuperadosObjeto = json_decode($jsonCorrompido, false, 512, JSON_THROW_ON_ERROR);

    echo "$dadosRecuperados<br>";
    var_dump($dadosRecuperadosObjeto);

    echo "<br>";
    var_dump($dadosRecuperados);

}catch(JsonException $e){
    echo $e->getMessage();
}