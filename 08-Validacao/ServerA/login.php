<?php 
session_save_path("../Central");
session_start();

$_SESSION["usuario"] = 'Joclertano';
echo "Login efetuado com sucesso";