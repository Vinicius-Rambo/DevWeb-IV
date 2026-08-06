<?php 

$conteudo_json = file_get_contents('escola.json');
$dados_obj = json_decode($conteudo_json);
$dados_array = json_decode(json_encode($dados_obj), true);
// echo "<hr>Formato Array <hr>";
// echo "<pre>";
// var_dump($conteudo_json);
// echo "</pre>";
// 
// echo "<hr>Formato Json <hr>";
// echo "<pre>";
// print_r($dados);
// echo "</pre>";

# Comentarios
// echo "Nome do aluno: " . $dados_array["alunos"][0]['nome']."<br>";
// echo "Nome do aluno: " . $dados_obj->alunos[0]->nome."<br>";

