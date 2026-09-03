<?php
require_once 'respostasJSON.php';
try{
    $nome = '';
    if(empty($nome)){
        throw new Exception("O campo 'nome' deve ser preenchido");
    }
    
    respostaJSON(["Sucesso"=>true, "Mensagem"=> "Dados inseridos com sucesso"], 200);

}catch(Exception $e){
    respostaJSON(["Sucesso" => false, "Erro: " => $e->getMessage()], 400);
}