<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/icon.svg" type="image/x-icon">
    <title>TCC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cabeca">
        <a href="index.php"><img class="logotipo" src="img/logo.png" alt="logo"></a>

        <div class="left">
            <a href="paginas/login.php"><button class="botao_login">Login</button></a>
            <span class="registrar" ><a href="paginas/cadastrar.php"><button class="btn_re">Registrar-se</button></a></span>
        </div>

        <?php
            if(isset($_SESSION['autenticado'])):
        ?>

        <div class="left_sessao">
            <h2>Bem-Vindo, <?php echo $_SESSION['usuario'];?></h2>
            <button class="btn_sair" onclick="logout()">Sair</button>
        </div>

        <?php
            endif;
        ?>
        
    </div>
    <h1>Comunidade de Ofertas!</h1>

    <div class="container" id="inicio">
        <div class="titulo"><h2>O que você procura?</h2>
        <form action="paginas/pesquisa.php" method="POST">
        <input id="pesquisar" type="text" name="pesquisar" placeholder="PESQUISAR" autocomplete= "off"> 
        <button><img src="img/lupa.png" alt="Pesquisar" class="btn_pesquisar"></button>
        </form>    
    </div>

        <div class="center">
            <div class="coluna" id="ultimas"><a href="paginas/ultimas.php"><img src="img/24h.jpg" alt=""><h3>Últimas 24h</h3></a></div>
            <div class="coluna"><a href="paginas/acessorios.php"><img src="img/acessorios.jpg" alt=""><h3>Acessórios</h3></a></div>
            <div class="coluna"><a href="paginas/alto_falante.php"><img src="img/alto_falante.jpg" alt=""><h3>Alto-Falante</h3></a></div>
            <div class="coluna"><a href="paginas/armazenamento.php"><img src="img/armazenamento.jpg" alt=""><h3>Armazenamento</h3></a></div>
            <div class="coluna"><a href="paginas/cadeira.php"><img src="img/cadeira.jpg" alt=""><h3>Cadeira</h3></a></div>
        </div>

        <div class="center">
            <div class="coluna"><a href="paginas/console.php"><img src="img/console.jpg" alt=""><h3>Console</h3></a></div>
            <div class="coluna"><a href="paginas/fone.php"><img src="img/fone.jpg" alt=""><h3>Fone</h3></a></div>
            <div class="coluna"><a href="paginas/fonte.php"><img src="img/fonte.jpg" alt=""><h3>Fonte</h3></a></div>
            <div class="coluna"><a href="paginas/gabinete.php"><img src="img/gabinete.jpg" alt=""><h3>Gabinete</h3></a></div>
            <div class="coluna"><a href="paginas/headset.php"><img src="img/headset.jpg" alt=""><h3>HeadSet</h3></a></div>
        </div>

        <div class="center">
            <div class="coluna"><a href="paginas/jogos.php"><img src="img/jogos.jpg" alt=""><h3>Jogos</h3></a></div>
            <div class="coluna"><a href="paginas/kit_upgrade.php"><img src="img/upgrade.jpg" alt=""><h3>Kit-Upgrade</h3></a></div>
            <div class="coluna"><a href="paginas/memoria_ram.php"><img src="img/Memoria Ram.png" alt=""><h3>Memória-RAM</h3></a></div>
            <div class="coluna"><a href="paginas/mesa.php"><img src="img/mesa.jpg" alt=""><h3>Mesa</h3></a></div>
            <div class="coluna"><a href="paginas/microfone.php"><img src="img/microfone.jpg" alt=""><h3>Microfone</h3></a></div>
            
        </div>

        <div class="center">
            <div class="coluna"><a href="paginas/monitor.php"><img src="img/monitor.jpg" alt=""><h3>Monitor</h3></a></div>
            <div class="coluna"><a href="paginas/mouse.php"><img src="img/mouse.jpg" alt=""><h3>Mouse/MousePad</h3></a></div>
            <div class="coluna"><a href="paginas/pc_notebook.php"><img src="img/notebook.jpg" alt=""><h3>PC/Notebook</h3></a></div>
            <div class="coluna"><a href="paginas/placa_de_video.php"><img src="img/placa_video.jpg" alt=""><h3>Placa-De-Vídeo</h3></a></div>
            <div class="coluna"><a href="paginas/placa_mae.php"><img src="img/placa_mae.jpg" alt=""><h3>Placa-Mãe</h3></a></div>
            
        </div>

        <div class="center">
            <div class="coluna"><a href="paginas/processador.php"><img src="img/processador.jpg" alt=""><h3>Processador</h3></a></div>
            <div class="coluna"><a href="paginas/refrigeracao.php"><img src="img/refrigeracao.jpg" alt=""><h3>Refrigeração</h3></a></div>
            <div class="coluna"><a href="paginas/smartphone.php"><img src="img/smartphone.jpg" alt=""><h3>Smartphone</h3></a></div>
            <div class="coluna"><a href="paginas/teclado.php"><img src="img/teclado.jpg" alt=""><h3>Teclado</h3></a></div>
            <div class="coluna"><a href="paginas/televisao.php"><img src="img/televisao.jpg" alt=""><h3>Televisão</h3></a></div>
        </div>

    </div>   
    
</body>
</html>