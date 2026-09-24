<?php
$payload=[
    'user_id'=>42,
    'nome'=>'Anaclétos',
    'perfil'=>'estudante',
    'exp'=>time() + 3600
];
echo "Vetor: <br>";
print_r($payload);
echo "<hr>vetor -> Json: <br>";
$json= json_encode($payload);
print_r($json);
echo "<hr>Json - base64: <br>";
$json64=base64_encode($json);
print_r($json64); 
echo "<hr>base64 -> base64URL: <br>";
$json64URL= str_replace(['+', '/','='], ['-','_',''], $json64);
print_r($json64URL);