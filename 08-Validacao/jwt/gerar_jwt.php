<?php

$chave_secreta = "MinhaSenhaSecreta";
$header=[
    "alg" => "HS256",
    "typ" => "JWT"
];

$payload=[
    "user_id" => 42,
    "nome" => "Anacléto",
    "perfil" => "estudante",
    "exp"=>time() + 3600
];

function base64URL_encode($dados){
    return  str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($dados));
}

$header_base64=base64URL_encode(json_encode($header));
$payload_base64=base64URL_encode(json_encode($payload));

$conteudo_para_assinar= $header_base64. "." . $payload_base64;

$assinatura_bruta= hash_hmac("sha256", $conteudo_para_assinar, $chave_secreta, true);
$assinatura_base64=base64URL_encode($assinatura_bruta);
$jwt = $header_base64. ".". $payload_base64 .".".$assinatura_base64;

echo "<textarea cols='100' rows='5'>{$jwt}</textarea>";