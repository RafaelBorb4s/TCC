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

        $categoria = "monitor"; //Mudar de acordo com a página
        $var1 = (string) limpaPost($_POST['reais']);
        $var2 = (string) limpaPost($_POST['centavos']);
        $valor = $var1.".". $var2;
        $link = limpaPost($_POST['link']);
        $produto = limpaPost($_POST['desc']);
                    
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("d/m/Y");
        $hora = date("H:i");
        $nome = $_SESSION['usuario'];
                    
        //Verificar Descrição
        if(empty($produto)){
            $erroProduto = "Descrição em Branco";
        }

        //Verificar Valor
        if(empty($Valor)){
            $erroValor = "Informar o valor do produto";
        }

        //Verificar Link
        if(empty($link)){
            $erroLink = "Link em branco";
        }elseif(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)){
            $erroLink = "Informar um link válido";
        }


        if(empty($link) and empty($valor) and empty($produto)){
            $erroProduto = "Descrição em Branco";
            $erroValor = "Informar o valor do produto";
            $erroLink = "Link em branco";
        }else{
            $comentar = "INSERT INTO `publicacoes`(`categoria`, `valor`, `link`, `produto`, `data`, `hora`, `nome`) VALUES ('$categoria','$valor','$link','$produto','$data','$hora','$nome')";
            if(mysqli_query($conexao, $comentar)){
                header('Location: monitor.php');//Mudar de acordo com as paginas
            }
        }   
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
            <li><a href="placa_de_video.php">Placa-De-Vídeo</a></li>
            <li><a href="placa_mae.php">Placa-Mãe</a></li>
            <li><a href="processador.php">Processador</a></li>
            <li><a href="refrigeracao.php">Refrigeração</a></li>
            <li><a href="smartphone.php">Smartphone</a></li>
            <li><a href="teclado.php">Teclado</a></li>
            <li><a href="televisao.php">Televisão</a></li>
          </ul>
    </div>

    <div class="titulo_paginas"><h2>Monitor</h2></div>

    <div class="conteudo">
        <?php
            $seleciona = mysqli_query($conexao, "SELECT * FROM `publicacoes` WHERE categoria = 'monitor' ORDER BY 'id' DESC"); //Mudar de acordo com a pagina
            $conta = mysqli_num_rows($seleciona);

            if($conta <= 0){
                echo"<p id=".'sem_publi'.">Está pagina ainda não possui publicações!</p>";
            }else{
                while($row = mysqli_fetch_array($seleciona)){
                    $id = $row['id'];
                    $nome1 = $row['nome'];
                    $produto1 = $row['produto'];
                    $comentario1 = $row['link'];
                    $valor1 = $row['valor'];
                    $data1 = $row['data'];
                    $hora1 = $row['hora'];   
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
        ?>
    </div>

    <div class="Modal">

        <div class="modal_body">
            <div class="modal_form">
                <div class="btn_fechar" onclick="fechar_modal()">X</div>
                <div class="titulo_modal"><H2 id="h2_modal">Monitor</H2></div>
                <form method="post">
                
                <div class="row">
                    <div class="col-25">
                        <label id="label_modal">Descrição</label>
                    </div>
                    <div class="col-75">
                        <input <?php if(!empty($erroProduto)){echo "class = 'invalido'";} ?> type="text" id="input_modal" name="desc" placeholder="Descreve o modelo do produto e se possui cumpom" autocomplete="off" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label id="label_modal">Valor</label>
                    </div>
                    <div class="col-75-valor">
                        <p id="simbolos">R$ </p><input <?php if(!empty($erroValor)){echo "class = 'invalido'";} ?> type="number" id="input_modal_reais" name="reais" placeholder="Reais" required><p id="simbolos">,</p> 
                        <input <?php if(!empty($erroValor)){echo "class = 'invalido'";} ?> type="number" id="input_modal_centavos" name="centavos" placeholder="centavos" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label id="label_modal">Link</label>
                    </div>
                    <div class="col-75">
                        <input <?php if(!empty($erroLink)){echo "class = 'invalido'";} ?> type="url" id="input_modal" name="link" autocomplete="off" placeholder="Cole aqui o link da oferta" required>
                    </div>
                </div>

                <div class="modal_footer">
                    <button class="btn_modal">Enviar</button>
                </div>

                </form>
            </div>
            
        </div>
    </div>

    <footer>

        <?php
            if(isset($_SESSION['autenticado'])){
                echo "<div class=".'publicar_logado'.">
                <div class=".'div_publicar_logado'."><button class=".'botao_publicar_autenticado'." onclick=".'publicar()'.">Publicar</button></div>
            </div>";
            }else{
                echo "<div class=".'publicar'.">
                <div class=".'div_publicar'."><button class=".'botao_publicar'." onclick=".'erro()'.">Publicar</button></div>
            </div>";
            }
        ?>
        
    </footer>
    
</body>
</html>