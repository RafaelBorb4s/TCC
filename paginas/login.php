<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/icon.svg" type="image/x-icon">
    <title>Login</title>
    <div class="logotipo"><a href="../index.php"><img src="../img/logo.png" alt="logo"></a></div>
</head>
<body class="logar">
    <script src="../app.js"></script>
    <div class="log">
        <h1>Login</h1>

            <?php
            if(isset($_SESSION['nao_autenticado'])):
            ?>

            <div class="msg">
                <p>ERRO: Usuário ou senha inválido!</p>
            </div>

            <?php
            endif;
            unset($_SESSION['nao_autenticado']);
            ?>

        <form action="verificar.php" method="POST" id="form_login">
            <label id="login_usuario" for="email">Usuário</label>
            <input class="log_usuario" type="txt" name="logusuario" id="login_input_usuario" placeholder="Digite seu usuário" autocomplete="off">
            <label id="login_senha" for="senha">Senha</label>
            <input class="log_senha" type="password" class="senha" name="logpassword" id="login_input_senha" placeholder="Digite sua senha">
            <div class="check_login"> <input type="checkbox" onclick="exibeSenha()" name="check_login" id="check_senha"> Mostrar Senha</div>
            <a class="esqueceu_senha" href="esqueceu_senha.php" id="esqueceu_senha">Esqueceu a senha ?</a>
            <button class="botao_logar"> Logar </button>
        </form>
        <div class="registre" id="registre">
            <p class="p_register">Ainda não tem conta?</p>
            <a class="link_login" href="cadastrar.php">Registra-se</a>
        </div>
    </div>
</body>
</html>