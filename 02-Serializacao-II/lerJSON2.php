<?php 

$conteudo_json = file_get_contents('escola.json');
$dados_obj = json_decode($conteudo_json);
$dados_array = json_decode(json_encode($dados_obj), true);

foreach($dados_array['alunos'] as $dados){
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

?>
