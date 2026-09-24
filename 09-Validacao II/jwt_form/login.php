<?php
$chave_secreta="MinhaSenhaSecreta123";

function base64url_encode($data){
    return str_replace(['+','/','='], ['-', '_', ''], base64_encode($data));
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["Usuario"]??"";
    $senha = $_POST["senha"]??"";
    if($usuario == "admin" && $senha == 123){
        $header = base64url_encode(json_encode(['typ'=>'JWT', 'alg'=>'JS256']));
        $payload= base64URL_encode(json_encode([
            "user_id"=>100,
            "nome" => "Anacléto",
            "exp"=> time() + 3600
        ]));

        $assinaturaBruta= hash_hmac('sha256', $header.".".$payload, $chave_secreta, true);
        $assinatura= base64_encode($assinaturaBruta);
        $jwt = $header.".".$payload.".".$assinatura;

        setcookie("meu_jwt", $jwt, time() + 3600, "/");
        header("Location: validar_jwt.php");
        exit;
    }
    else{
        echo "Usuario ou senha incrretos";
    }    
}
?>

<form method="post">
    <label> Usuario </label>
    <input type="text" name = "usuario"> <br>

    <label> Senha: </label>
    <input type="password" name="senha">

    <input type="submit" value="Enviar">

</form>