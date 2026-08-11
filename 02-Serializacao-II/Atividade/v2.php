<?php

$dados = null;
$buscou = false;
$encontrou = false;

if($_POST){
    $buscou = true;

    $cep = $_POST['cep'];
    $url = "https://viacep.com.br/ws/" . $cep . "/json/";

    $json = @file_get_contents($url);

    if($json){
        $dados = json_decode($json);

        if(isset($dados->cep)){
            $encontrou = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td, th {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        form {
            margin-top: 30px;
        }
        .erro {
            color: red;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
    <title>CEP</title>
</head>
<body>
    <form action="" method="POST">
        <label for="cep">CEP: </label>
        <input type="text" name="cep" id="cep" required>
        <button type="submit">CONSULTAR</button>
    </form>
    
    <?php if ($buscou && $encontrou): ?> <!--Funciona apenas se ambos forem verdadeiros -->
        <table>
            <tr>
                <th>CEP</th>
                <th>Logradouro</th>
                <th>Complemento</th>
                <th>Unidade</th>
                <th>Bairro</th>
                <th>Localidade</th>
                <th>UF</th>
                <th>Estado</th>
                <th>Região</th>
                <th>IBGE</th>
                <th>GIA</th>
                <th>DDD</th>
                <th>Siafi</th>
            </tr>
    
            <tr>
                <td><?= $dados->cep ?></td>
                <td><?= $dados->logradouro ?></td>
                <td><?= $dados->complemento ?></td>
                <td><?= $dados->unidade ?></td>
                <td><?= $dados->bairro ?></td>
                <td><?= $dados->localidade ?></td>
                <td><?= $dados->uf ?></td>
                <td><?= $dados->estado ?></td>
                <td><?= $dados->regiao ?></td>
                <td><?= $dados->ibge ?></td>
                <td><?= $dados->gia ?></td>
                <td><?= $dados->ddd ?></td>
                <td><?= $dados->siafi ?></td>
            </tr>
        </table>

    <?php elseif ($buscou && !$encontrou): ?>
        <p class="erro">CEP INVALIDO</p>

    <?php endif; ?>

</body>
</html>
