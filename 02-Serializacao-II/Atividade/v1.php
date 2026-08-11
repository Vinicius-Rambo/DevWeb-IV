<?php

if($_POST){
    $encontrou = false;
    $url = "https://viacep.com.br/ws/" . $_POST['cep'] . "/json/";

    $json = file_get_contents($url);
    $dados = json_decode($json);

    if($dados->cep){
        $encontrou = true;
        echo "<table>";

        //Cabeçalho
        echo "<tr>";
            echo "<th>CEP</th>";
            echo "<th>Logadouro</th>";
            echo "<th>Complemento</th>";
            echo "<th>Unidade</th>";
            echo "<th>Bairro</th>";
            echo "<th>Localidade</th>";
            echo "<th>UF</th>";
            echo "<th>Estado</th>";
            echo "<th>Regiao</th>"
            echo "<th>IBGE</th>"
            echo "<th>GIA</th>"
            echo "<th>DDD</th>"
            echo "<th>Siafi</th>"
        echo "</tr>";

        echo "<tr>";
            echo "<td>" . $dados->cep . "</td>";
            echo "<td>" . $dados->logradouro . "</td>";
            echo "<td>" . $dados->complemento . "</td>";
            echo "<td>" . $dados->unidade . "</td>";
            echo "<td>" . $dados->bairro . "</td>";
            echo "<td>" . $dados->localidade . "</td>";
            echo "<td>" . $dados->uf . "</td>";
            echo "<td>" . $dados->estado . "</td>";
            echo "<td>" . $dados->regiao . "</td>";
            echo "<td>" . $dados->ibge . "</td>";
            echo "<td>" . $dados->gia . "</td>";
            echo "<td>" . $dados->ddd . "</td>";
            echo "<td>" . $dados->siafi . "</td>";
        echo "</tr></table>";
    }

    if(!$encontrou){
        echo "CEP INVALIDO";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEP</title>

</head>
<body>
    <form action="" method="POST">

        <label for="">CEP:</label>
        <input type="text" name="cep">
        <button type="submit">Verificar</button>
    </form>
</body>
</html>