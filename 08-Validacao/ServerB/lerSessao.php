<?php
session_save_path("../Central");
session_start();

if(isset($_SESSION['usuario'])){
    echo "Bem vindo " . $_SESSION['usuario'];
}

else{ 
    echo "Erro no Server B: Usuario não autenticado";
}

?>