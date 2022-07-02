<?php
session_start();
include_once("../conexao.php");
include_once("../processa.php");
$nome = "";

    if(isset($_SESSION['autenticado'])){
        $nome = $_SESSION['usuario'];
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <script src="https://kit.fontawesome.com/0bb8dc907c.js" crossorigin="anonymous"></script>   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/icon.svg" type="image/x-icon">
    <title>TCC</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../style_responsive.css">
</head>
<body>
    <script src="../app.js"></script>
    <div class="cabeca">
        <a href="../index.php"><img class="logotipo" src="../img/logo.png" alt="logo"></a>

        <?php
            if(isset($_SESSION['autenticado'])){
                $nome_usuario = ucfirst($_SESSION['usuario']);
                echo "<div class=".'left_sessao'.">
                <h2>Bem-Vindo, $nome_usuario</h2>
                <a href=".'editar_perfil.php'."><button class = ".'btn_editar_perfil'.">Editar Perfil</button> </a>
                <button class=".'btn_sair'." onclick=".'logout()'.">Sair</button>
            </div>";
            }else{
                echo "<div class=".'left'.">
                <a href=".'login.php'."><button class=".'botao_login'.">Login</button></a>
                <span class=".'registrar'." ><a href=".'cadastrar.php'."><button class=".'btn_re'.">Registrar-se</button></a></span>
            </div>";
            }
        ?>
        
    </div>

    <div class="bar_menu">
        <ul>
            <li><a href="ultimas.php">Últimas 24 horas</a></li>
            <li><a href="acessorios.php">Acessórios</a></li>
            <li><a href="alto_falante.php">Alto Falante</a></li>
            <li><a href="armazenamento.php">Armazenamento</a></li>
            <li><a href="cadeira.php">Cadeira</a></li>
            <li><a href="console.php">Console</a></li>
            <li><a href="fone.php">Fone</a></li>
            <li><a href="fonte.php">Fonte</a></li>
            <li><a href="gabinete.php">Gabinete</a></li>
            <li><a href="headset.php">Headset</a></li>
            <li><a href="jogos.php">Jogos</a></li>
            <li><a href="kit_upgrade.php">Kit-Upgrade</a></li>
            <li><a href="memoria_ram.php">Memória-RAM</a></li>
            <li><a href="mesa.php">Mesa</a></li>
            <li><a href="microfone.php">Microfone</a></li>
            <li><a href="monitor.php">Monitor</a></li>
            <li><a href="mouse.php">Mouse/MousePad</a></li>
            <li><a href="pc_notebook.php">PC/Notebook</a></li>
            <li><a href="placa_de_video.php">Placa De Vídeo</a></li>
            <li><a href="placa_mae.php">Placa-Mãe</a></li>
            <li><a href="processador.php">Processador</a></li>
            <li><a href="refrigeracao.php">Refrigeração</a></li>
            <li><a href="smartphone.php">Smartphone</a></li>
            <li><a href="teclado.php">Teclado</a></li>
            <li><a href="televisao.php">Televisão</a></li>
          </ul>
    </div>

    <div class="titulo_paginas"><h2>Últimas 24 horas</h2></div>

    <div class="conteudo">
        <?php
            date_default_timezone_set('America/Sao_Paulo');
            $data_atual = date("d/m/Y");
            $hora_atual = date("H:i");

            //Ontem
            $d = date("d");
            $m = date("m");
            $Y = date("Y");
            $ontem = date("d/m/Y", mktime(0, 0, 0, $m, $d-1, $Y));
            
            $seleciona = mysqli_query($conexao, "SELECT * FROM `publicacoes` WHERE data = '$data_atual' or data = '$ontem' ORDER BY id DESC");
            $conta = mysqli_num_rows($seleciona);

            if($conta <= 0){
                echo"<p id=".'sem_publi'.">Não teve nenhum Post nas últimas 24h!</p>";
            }else{
                while($row = mysqli_fetch_array($seleciona)){
                    $id = $row['id'];
                    $nome1 = $row['nome'];
                    $produto1 = $row['produto'];
                    $comentario1 = $row['link'];
                    $valor1 = $row['valor'];
                    $data1 = $row['data'];
                    $hora1 = $row['hora'];

                    $formatado_certo_atual = $data_atual." ".$hora_atual;
                    $formatado_certo_publi = $data1." ".$hora1;
                    $atual = DateTime::createFromFormat("d/m/Y H:i" , $formatado_certo_atual);
                    $postagem = DateTime::createFromFormat("d/m/Y H:i" , $formatado_certo_publi);
                    $diferenca = $atual->diff($postagem);
                    if($diferenca->h < 24 && $diferenca->d < 1){   
        ?>

        <div class="publi">
                        <div class="nome"><p>Usuário: <b><?php echo $nome1; ?></b><a id="editar_publi" <?php echo "href= editar.php?id=$id";?> ><?php if(strtolower($nome) == strtolower($nome1)){echo "Editar";} ?></a><a id="deletar_publi" <?php echo "href= delete.php?id=$id";?>> <?php if(strtolower($nome) == strtolower($nome1)){echo "&#x274C;";} ?></a></p></div>
                        <div class="desc"><p>Descrição: <?php echo $produto1; ?></p></div>
                        <div class="Valor"><p>Preço: R$<?php echo number_format($valor1, 2, ",", "."); ?></p></div>
                        <div class="Link_publi"><p><i class="fa-solid fa-link"></i>Link para a oferta: <a target="_blank" id="link_publi" <?php echo "href='".$comentario1."'";?>><?php echo $comentario1; ?> </a></p></div> 
                        <div class="data_publi"><p><i class="fa-regular fa-clock"></i> <?php echo $data1; ?> ás <?php echo $hora1; ?></p></div> 
        </div>

        <?php
                    }
                }
            }
        ?>
    </div>
    
</body>
</html>