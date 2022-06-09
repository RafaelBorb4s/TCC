<?php 
session_start();
include('../conexao.php');

$usuario = mysqli_real_escape_string($conexao, $_POST['logusuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['logpassword']);
$senha_cript = sha1($senha);

$query = " SELECT * FROM `usuarios` WHERE usuario = '$usuario' and senha = '$senha_cript'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

if($row == 1){
    $_SESSION['autenticado'] = true;
    $_SESSION['usuario'] = $usuario;
    header('Location: ../index.php');
    exit();
}else{
    $_SESSION['nao_autenticado'] = true;
    header('Location: login.php');
    exit();
}
?>