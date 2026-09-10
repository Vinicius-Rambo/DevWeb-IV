<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de cadastro de produto</title>
</head>
<body>
    <h2>Cadastrar Produto</h2>
    <form id="formProduto">
        <label>Nome: </label><br> 
        <input type="text" name="nome" id="nome"><br><br>
        
        <label>Preço: </label><br> 
        <input type="number" step="0.01" name="preco" id="preco"><br><br>

        <button type="submit">Enviar para a API </button>

    </form>
    <div id="resposta">



    </div>
    <script>
        document.getElementById('formProduto').addEventListener('submit', function(e){
            e.preventDefault(); //Torna o form assincrono

            const formData = new FormData(this); //Instancia de um objeto Form
            const dados = Object.fromEntries(fromData); //Captura os campos e transforma em Json

            fetch('../API/index.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json' //Indica que o conteudo que está sendo enviado é um JSON
                },
                body: JSON.stringify(dados) //Transforma os dados em formato de string.
            })
                .then(response => response.text()) //Armazena em formato de texto
                .then(texto => { 
                    //console.log("Resposta bruta do servidor: ", texto);
                    let resp = document.getElementById("resposta");
                    resp.innerHTML = resp;   
                });

        });

        
    </script>
</body>
</html>