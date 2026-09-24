<?php
/**
 * ============================================================================
 * GUIA DE IMPLEMENTAÇÃO: jwt_helper.php
 * ============================================================================
 * Este arquivo deve conter as funções matemáticas e utilitárias de manipulação
 * do padrão JWT (RFC 7519) em PHP puro.
 *
 * PASSO A PASSO PARA O ALUNO IMPLEMENTAR:
 *
 * 1. Crie a função base64url_encode($data):
 *    - Execute base64_encode($data)
 *    - Use str_replace() para substituir os 3 caracteres problemáticos:
 *      '+' -> '-'
 *      '/' -> '_'
 *      '=' -> '' (remover)
 *
 * 2. Crie a função base64url_decode($data):
 *    - Recomponha o padding '=' calculando o tamanho da string % 4.
 *    - Faça a troca inversa dos caracteres '-' e '_' por '+' e '/'.
 *    - Execute base64_decode() no resultado.
 *
 * 3. Crie a função gerar_jwt($payload_array):
 *    - Crie o $header = ['alg' => 'HS256', 'typ' => 'JWT'];
 *    - Converta o Header e o Payload para JSON com json_encode().
 *    - Converta os dois JSONs para Base64URL.
 *    - Concatene: $conteudo = $header_b64 . '.' . $payload_b64;
 *    - Calcule o hash: $assinatura_bruta = hash_hmac('sha256', $conteudo, JWT_SECRET, true);
 *    - Converta a assinatura bruta para Base64URL.
 *    - Retorne a junção completa: $header_b64 . '.' . $payload_b64 . '.' . $assinatura_b64;
 *
 * 4. Crie a função validar_jwt($jwt_string):
 *    - Separe o token usando explode('.', $jwt_string) em 3 partes.
 *    - Se não houver 3 partes, retorne false.
 *    - Recalcule a assinatura das duas primeiras partes usando a constante JWT_SECRET.
 *    - Compare a assinatura recalculada com a assinatura recebida no token usando hash_equals().
 *    - Decodifique o Payload e verifique a expiração ('exp' < time()).
 *    - Se tudo estiver correto, retorne o array do $payload. Caso contrário, retorne false.
 * ============================================================================
 */

require_once __DIR__ . '/config.php';


function base64url_encode ($data){
    return str_replace(['+','/','='], ['-', '_', ''], base64_encode($data));
}

function base64url_decode($data){
    return base64_decode(str_replace(['-', '', '_'], ['+', '=', '/'],$data));
}

function gerar_jwt($payload_array){
    $header = base64url_encode(json_encode(['typ'=>'JWT', 'alg'=>'JS256']));
    $payload = base64url_encode(json_encode($payload_array)); 

    $conteudo = $header .'.'. $payload;

    $assinatura_bruta = hash_hmac('sha256', $conteudo, JWT_SECRET, true);
    $assinatura = base64_encode($assinatura_bruta);
    $jwt = $header .'.'.$payload.'.'.$assinatura;

    return $jwt;
}

function validar_jwt($jwt_string){
    $partes = explode('.', $jwt_string);

    if(count($partes) != 3){ 
        return false;
    }

    $header_base64 = $partes[0];
    $payload_base64 = $partes[1];
    $assinatura_cliente = $partes[2];

    $assinaturaBruta = hash_hmac('sha256', $header_base64.".".$payload_base64, JWT_SECRET, true);
    $assinaturaRecalculada=str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($assinaturaBruta));


    if($assinaturaRecalculada !== $assinatura_cliente){
        return false;
    }
    else{
        return true;  

    }
}
