<?php
session_start();
include_once("../conexao.php");

$nome = "";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$sql_id = "SELECT * FROM `publicacoes` WHERE id = '$id'";
$resultado = mysqli_query($conexao, $sql_id);
$linha = mysqli_fetch_assoc($resultado);
$categoria = $linha['categoria'];

if(!empty($id)){
    if(isset($_SESSION['autenticado'])){
        $nome = $_SESSION['usuario'];
    }
    
    if(isset($_SESSION['autenticado'])){
        $sql = "DELETE FROM `publicacoes` WHERE nome = '$nome' AND id = '$id'";
        if(mysqli_query($conexao, $sql)){
            header("Location: $categoria.php");
        }
    }
}else{
    header("Location: ../index.php");
}

?>