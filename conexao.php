<?php 
//Configurações Gerais
$hostname = "localhost";
$user = "root";
$password = "";
$database = "cadastro";

$conexao = mysqli_connect($hostname, $user, $password, $database);

if(!$conexao){
    echo"Falha na conexão com o Banco de Dados.";
}

function limpaPost($valor){
    $valor = trim($valor);
    $valor = stripslashes($valor);
    $valor = htmlspecialchars($valor);
    return $valor;
}

?>
