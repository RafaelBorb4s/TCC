<?php
include_once("../conexao.php");
include_once("../processa.php");
include_once("processa_publi.php");
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

    <div class="titulo_paginas"><h2>Monitor</h2></div>

    <div class="conteudo">
        <?php
            $seleciona = mysqli_query($conexao, "SELECT * FROM `publicacoes` WHERE categoria = 'monitor' ORDER BY id DESC"); //Mudar de acordo com a pagina
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
                        <input <?php if(!empty($erroProduto)){echo "class = 'invalido' ";} ?> <?php if(isset($_POST['desc'])){echo "value = '".$_POST['desc']."'";} ?> type="text" id="input_modal" name="desc" placeholder="Descreve o modelo do produto e se possui cumpom" autocomplete="off" required>
                        <span class="erro"><?php echo $erroProduto; ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label id="label_modal">Valor</label>
                    </div>

                    <div class="col-75-valor">
                        <p id="simbolos">R$ </p><input <?php if(!empty($erroValor)){echo "class = 'invalido' ";} ?> <?php if(isset($_POST['reais'])){echo "value = '".$_POST['reais']."'";} ?> type="text" id="input_modal_reais" name="reais" placeholder="  $$$.$$" maxlength="11" autocomplete="off" required>  
                        <span class="erro"><?php echo $erroValor; ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label id="label_modal">Link</label>
                    </div>

                    <div class="col-75">
                        <input <?php if(!empty($erroLink)){echo "class = 'invalido' ";} ?> <?php if(isset($_POST['link'])){echo "value = '".$_POST['link']."'";} ?> type="url" id="input_modal" name="link" autocomplete="off" placeholder="Cole aqui o link da oferta" required>
                        <span class="erro"><?php echo $erroLink; ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label id="label_modal">Tempo</label>
                    </div>

                    <div class="col-75">
                        <div>
                            <input type="radio" name="theradio" id="meia_hora" value="meia_hora"><label for="meia_hora"> 30 minutos</label> 
                            <input type="radio" name="theradio" id="uma_hora" value="uma_hora"><label for="uma_hora"> 1 hora</label> 
                            <input type="radio" name="theradio" id="12_horas" value="12_horas"><label for="12_horas"> 12 horas</label> 
                            <input type="radio" name="theradio" id="24_horas" value="24_horas"><label for="24_horas"> 24 horas</label> 
                            <input type="radio" name="theradio" id="uma_semana" value="uma_semana"><label for="uma_semana"> 1 semana</label> 
                            <input type="radio" name="theradio" id="um_mes" value="um_mes" checked><label for="um_mes"> 1 mês</label> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                    <label id="label_modal" for="">Categorias:</label>
                    </div>

                    <div class="col-75">
                        <select id="input_modal" name="Categoria" required>
                            <option value="acessorios">Acessórios</option>
                            <option value="alto_falante" >Alto Falante</option>
                            <option value="armazenamento">Armazenamento</option>
                            <option value="cadeira">Cadeira</option>
                            <option value="console">Console</option>
                            <option value="fone">Fone</option>
                            <option value="fonte">Fonte</option>
                            <option value="gabinete">Gabinete</option>
                            <option value="headset">Headset</option>
                            <option value="jogos">Jogos</option>
                            <option value="kit_upgrade">Kit Upgrade</option>
                            <option value="memoria_Ram">Memoria RAM</option>
                            <option value="mesa">Mesa</option>
                            <option value="microfone">Microfone</option>
                            <option value="monitor" selected>Monitor</option>
                            <option value="mouse">Mouse/MousePad</option>
                            <option value="pc_notebook">PC/Notebook</option>
                            <option value="placa_de_video">Placa de Video</option>
                            <option value="placa_mae">Placa Mãe</option>
                            <option value="processador">Processador</option>
                            <option value="refrigeracao">Refrigeração</option>
                            <option value="smartphone">Smartphone</option>
                            <option value="teclado">Teclado</option>
                            <option value="televisao">Televisão</option>
                        </select>
                    </div>
                </div>                                             

                <div class="modal_footer">
                    <input type="submit" class="btn_modal">
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