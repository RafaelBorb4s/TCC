<?php
include_once("conexao.php");

$sql10 = mysqli_query($conexao,"SELECT * FROM `publicacoes` WHERE data_excluir != '' ORDER BY id DESC ");
$contador = mysqli_num_rows($sql10);
if($contador > 0){
    while($linha10 = mysqli_fetch_array($sql10)){
        date_default_timezone_set('America/Sao_Paulo');
        $data_agora = date("d/m/Y H:i");

        $excluir = $linha10['data_excluir'];    
        
        
        if($data_agora == $excluir){
            $sql_delete = mysqli_query($conexao,"DELETE FROM `publicacoes` WHERE data_excluir = '$excluir' ");  
        }
    }
}

?>