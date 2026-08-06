<?php

$conteudo_json = file_get_contents('escola.json');
$dados_obj = json_decode($conteudo_json);
$dados_array = json_decode(json_encode($dados_obj), true);

if($_POST){
    $encontrou=false;
    foreach($dados_array['alunos'] as $dados){

        if($_POST['nome'] === $dados['nome']){
            $encontrou=true;
            echo '<pre>';
            echo "Nome do aluno: " .$dados['nome']."<br>"; 
            echo "Turma do aluno: " .$dados['turma']."<br>"; 
            echo "Status do aluno: " .$dados['status']."<br>";

            foreach($dados['boletim'] as $boletim){
                echo "Materia: " .$boletim['materia']."<br>";
                echo "Notas: " .$boletim['nota']."<br>";
            }
            echo '<pre>';   
        }
    }

    if(!$encontrou){
        echo "Aluno não encontrado";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>
    <form method="POST" action="">
        <label>Filtro: </label>
        <input type="text" name="nome">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
