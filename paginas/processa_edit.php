<?php
session_start();
include_once("../conexao.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$Desc = filter_input(INPUT_POST, 'Desc', FILTER_SANITIZE_STRING);
$reais = filter_input(INPUT_POST, 'reais', FILTER_SANITIZE_NUMBER_INT);
$centavos = filter_input(INPUT_POST, 'centavos', FILTER_SANITIZE_NUMBER_INT);
$Link = filter_input(INPUT_POST, 'Link', FILTER_SANITIZE_URL);
$Categoria = filter_input(INPUT_POST, 'Categoria', FILTER_SANITIZE_STRING);

$Valor = $reais.".".$centavos;

date_default_timezone_set('America/Sao_Paulo');
$data = date("d/m/Y");
$hora = date("H:i");

$sql_update = "UPDATE `publicacoes` SET `categoria`='$Categoria',`valor`='$Valor',`link`='$Link',`produto`='$Desc',`data`='$data',`hora`='$hora' WHERE id = '$id'";
$resultado_update = mysqli_query($conexao, $sql_update);

if(mysqli_affected_rows($conexao)){
    header("Location: ../index.php");
}else{
    header("Location: ../index.php");
}
?>