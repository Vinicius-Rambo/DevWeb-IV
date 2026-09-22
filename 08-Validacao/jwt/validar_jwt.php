<?php
$chave_secreta = "MinhaSenhaSecreta";
$jwt_recebido="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjo0Miwibm9tZSI6IkFuYWNsXHUwMGU5dG8iLCJwZXJmaWwiOiJlc3R1ZGFudGUiLCJleHAiOjE3ODk2MDg4Mjd9.Ys8yiMQ3-9R6xRYitOSPj-juEIe0LukU0ev_J5Vqnvo";

function base64URL_encode($dados){
    return  str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($dados));
}

function base64URL_decode($dados){
    return  str_replace(['-', '_', ''], ['+', '/', '='], base64_decode($dados));
}

$partes = explode(".", $jwt_recebido);
if(count($partes) !==3){
    die("Formato de token invalido");
}

$header_base64=$partes[0];
$payload_base64=$partes[1];
$assinatura_cliente_base64=$partes[2];

$conteudo_para_assinar = $header_base64.".".$payload_base64;
$assinatura_recalculada = hash_hmac('sha256', $conteudo_para_assinar, $chave_secreta, true);
$assinatura_recalculada_base64 = base64URL_encode($assinatura_recalculada);

if($assinatura_recalculada_base64 !== $assinatura_cliente_base64){
    die('ERRO: Token inválido');
}

$decode = base64URL_decode($payload_base64);
$payload=json_decode($decode, true);
if(isset($payload['exp']) && $payload['exp'] < time()){
    die('Erro: Token expirado');
}

echo "Usuário autenticado: ". $payload['nome']."<br>";


?>


