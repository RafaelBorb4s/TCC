<?php
session_start();
include_once("../conexao.php");
//Conteudo de erro
$erroLink = "";
$erroValor = "";
$erroProduto = "";

$nome = "";

if(isset($_SESSION['autenticado'])){
    $nome = ucfirst($_SESSION['usuario']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    
    //Verificar Descrição
    if(empty($_POST['desc'])){
        $erroProduto = "Descrição em Branco";
    }

    //Verificar Valor
    if(strpos($_POST['reais'], ",") !== false){
        $_POST['reais'] = str_replace(",",".",$_POST['reais']);
    }elseif(empty($_POST['reais'])){
        $erroValor = "Informar o valor do produto";
    }elseif(filter_var($_POST['reais'], FILTER_VALIDATE_FLOAT ) == false){
        $erroValor = "Informar um número correto. Exemplo: 99.99";   
    }

    //Verificar Link
    if(empty($_POST{'link'})){
        $erroLink = "Link em branco";
    }elseif(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$_POST['link'])){
        $erroLink = "Informar um link válido";
    }

    //Verificar Tempo
    if($_POST['theradio'] == "meia_hora"){
        $data_atual = date("d/m/Y");
        $hora_atual = date("H:i");
        $formatar = $data_atual." ".$hora_atual;

        $formatar = DateTime::createFromFormat("d/m/Y H:i", $formatar);
        $formatar->add(new DateInterval('PT0H30M')); // 30 minutos
        $data_excluir = $formatar->format("d/m/Y H:i");
    }
    if($_POST['theradio'] == "uma_hora"){
        $data_atual = date("d/m/Y");
        $hora_atual = date("H:i");
        $formatar = $data_atual." ".$hora_atual;

        $formatar = DateTime::createFromFormat("d/m/Y H:i", $formatar);
        $formatar->add(new DateInterval('PT1H0M')); // 1 horas
        $data_excluir = $formatar->format("d/m/Y H:i");
    }
    if($_POST['theradio'] == "12_horas"){
        $data_atual = date("d/m/Y");
        $hora_atual = date("H:i");
        $formatar = $data_atual." ".$hora_atual;

        $formatar = DateTime::createFromFormat("d/m/Y H:i", $formatar);
        $formatar->add(new DateInterval('PT12H0M')); // 12 horas
        $data_excluir = $formatar->format("d/m/Y H:i");
    }
    if($_POST['theradio'] == "24_horas"){
        $data_atual = date("d/m/Y");
        $hora_atual = date("H:i");
        $formatar = $data_atual." ".$hora_atual;

        $formatar = DateTime::createFromFormat('d/m/Y H:i', $formatar);
        $formatar->add(new DateInterval('PT24H0M')); // 1 dias
        $data_excluir = $formatar->format('d/m/Y H:i');
        
    }
    if($_POST['theradio'] == "uma_semana"){
        $data_atual = date("d/m/Y");
        $hora_atual = date("H:i");
        $formatar = $data_atual." ".$hora_atual;

        $formatar = DateTime::createFromFormat('d/m/Y H:i', $formatar);
        $formatar->add(new DateInterval('PT168H0M')); // 7 dias
        $data_excluir = $formatar->format('d/m/Y H:i');
    }
    if($_POST['theradio'] == "um_mes"){
        $data_atual = date("d/m/Y");
        $hora_atual = date("H:i");
        $formatar = $data_atual." ".$hora_atual;

        $formatar = DateTime::createFromFormat('d/m/Y H:i', $formatar);
        $formatar->add(new DateInterval('PT720H0M')); // 30 dias
        $data_excluir = $formatar->format('d/m/Y H:i');
    }

    $categoria = filter_input(INPUT_POST, 'Categoria');
                    
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("d/m/Y");
    $hora = date("H:i");
    $nome = $_SESSION['usuario'];

    $valor = $_POST['reais'];
    $link = limpaPost($_POST['link']);
    $produto = $_POST['desc'];

    if(($erroProduto == "") && ($erroValor == "") && ($erroLink == "")){
        $comentar = "INSERT INTO `publicacoes`(`categoria`, `valor`, `link`, `produto`, `data`, `hora`, `nome`, `data_excluir`) VALUES ('$categoria','$valor','$link','$produto','$data','$hora','$nome','$data_excluir')";
        if(mysqli_query($conexao, $comentar)){
            header('Location: '.$categoria.'.php');//Mudar de acordo com as paginas
            mysqli_close($conexao);
        }
    }      
}

?>