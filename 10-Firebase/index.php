<?php
// index.php
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + Firebase Realtime</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        #caixa-status {
            padding: 15px;
            border: 2px solid #2196F3;
            background-color: #e3f2fd;
            border-radius: 5px;
        }

        .texto-alerta {
            color: #0d47a1;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Mensagem em Tempo Real do Firebase</h1>

    <div id="caixa-status">
        Mensagem atual: <span id="texto-status" class="texto-alerta">A carregar dados...</span>
    </div>

    <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
    import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js"

    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyAWHQF5GSiLXx1z1kVWlVT_aTg4vv0fz6Y",
        authDomain: "aula-php-firebase.firebaseapp.com",
        databaseURL: "https://aula-php-firebase-default-rtdb.firebaseio.com",
        projectId: "aula-php-firebase",
        storageBucket: "aula-php-firebase.firebasestorage.app",
        messagingSenderId: "686626139461",
        appId: "1:686626139461:web:347b58d1b7bba9dc9be22c"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig); //Em um banco tradicional seria o drive de conexão
    const db = getDatabase(app); // No tradicional seria o objeto de conexão.

    const caminhoMensagem = ref(db, 'mensagem'); //Do banco de dados usar o Nó "mensagem"
    
    onValue(caminhoMensagem, (snapshot) => {
        const valor = snapshot.val();
        if (valor !== null){
            document.getElementById("texto-status").innerHTML = valor;
        } else{
            document.getElementById("texto-status").innerHTML = "Nenhuma mensagem";
            
        }
    });
    


    </script>


</body>

</html>