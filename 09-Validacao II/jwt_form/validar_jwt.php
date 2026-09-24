<?php

$chave_secreta="MinhaSenhaSecreta123";

function base64url_decode($data){
    return base64_decode(str_replace(['-', '', '_'], ['+', '=', '/'],$data));
}

if(!isset($_COOKIE['meu_jwt'])){
    die("Acesso negado <a href='login.php'> Fazer login </a>");
}

$jwt_recebido = $_COOKIE['meu_jwt'];
$partes = explode('.', $jwt_recebido);

if(count($partes) != 3){ 
    die("Acesso negado: Token inválido <a href='login.php'> Fazer login </a>");
}

$header_base64 = $partes[0];
$payload_base64 = $partes[1];
$assinatura_cliente = $partes[2];

$assinaturaBruta = hash_hmac('sha256', $header_base64.".".$payload_base64, $chave_secreta, true);
$assinaturaRecalculada=str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($assinaturaBruta));

if($assinaturaRecalculada !== $assinatura_cliente){
    die("ALERTA: Token adulterado");

}

$payload = json_decode(base64URL_decode($payload_base64),true); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Olá <?php echo $payload["nome"];  ?> </h1>
</body>
</html>