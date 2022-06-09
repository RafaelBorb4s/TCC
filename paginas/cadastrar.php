<?php
include_once("../conexao.php");

$errousuario = "";
$erroemail = "";
$errosenha = "";
$erroConfirmeSenha = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Validação Usuario
    if(empty($_POST['usuario'])){
        $errousuario = "Preencha um usuario!";
    }else{
        $usuario = limpaPost($_POST['usuario']);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$usuario)) {
            $errousuario = "Somente letras!";
        }
        $query1 = " SELECT * FROM `usuarios` WHERE usuario = '$usuario'";
        $result1 = mysqli_query($conexao, $query1);
        $row1 = mysqli_num_rows($result1);
        if($row1 == 1){
            $errousuario = "Usuário já existe!";
        }
    }

    //Validação E-mail
    if(empty($_POST['email'])){
        $erroemail = "Por favor, informe um e-mail!";
    }else{
        $email = limpaPost($_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erroemail = "E-mail inválido!";
        }
        $query = " SELECT * FROM `usuarios` WHERE email = '$email'";
        $result = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($result);
        if($row == 1){
            $erroemail = "E-mail já cadastrado!";
        }
    }

    //Validação de Senha
    if(empty($_POST['cadpassword'])){
        $errosenha = "Informe uma senha!";
    }else{
        $senha = limpaPost($_POST['cadpassword']);
        if(strlen($senha) < 8){
            $errosenha = "A senha precisa ter no mínimo 8 dígitos!";
        }
    }

    //Validação de Confirma a senha
    if(empty($_POST['confirme_password'])){
        $erroConfirmeSenha = "Informe a repetição da senha!";
    }else{
        $ConfirmeSenha = limpaPost($_POST['confirme_password']);
        if($ConfirmeSenha != $senha){
            $erroConfirmeSenha = "As senhas não conferem!";
        }
    }

    //Insere o usuario na Tabelda de SQL
    if(($errousuario == "") && ($erroemail == "") && ($errosenha == "") && ($erroConfirmeSenha == "")){

        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $senha = $_POST['cadpassword'];
        $senha_cript = sha1($senha);
        $data_cadastro = date('d/m/Y');

        $sql = "INSERT INTO `usuarios`(`usuario`, `email`, `senha`, `data`) VALUES ('$usuario','$email','$senha_cript','$data_cadastro')";
        $salvar = mysqli_query($conexao, $sql);

        mysqli_close($conexao);

        header('Location: login.php');   
    }

}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <script src="../app.js"></script>
    <script src="https://kit.fontawesome.com/0bb8dc907c.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/icon.svg" type="image/x-icon">
    <title>Cadastro</title>
    <div class="logotipo"><a href="../index.php"><img src="../img/logo.png" alt="logo"></a></div>
</head>
<body class="logar">
    <div class="cad">
        <h1>Cadastro</h1>
        <form id="frm1" method="post">
            <label class="labelusuario" id="labelusuario">Usuário</label>
            <input <?php if(!empty($errousuario)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['usuario'])){echo "value = '".$_POST['usuario']."'";} ?> type="usuario" name="usuario" id="cadusuario" placeholder="Digite seu usuario" autocomplete="off" >
            <span class="erro"> <?php echo $errousuario; ?> </span>

            <label class="labelemail" id="labelemail">E-mail</label>
            <input <?php if(!empty($erroemail)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['email'])){echo "value = '".$_POST['email']."'";} ?> type="email" name="email" id="cademail" placeholder="Digite Seu e-mail" autocomplete="off" >
            <span class="erro"> <?php echo $erroemail; ?></span>

            <label class="labelsenha" id="labelsenha">Senha</label>
            <input <?php if(!empty($errosenha)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['cadpassword'])){echo "value = '".$_POST['cadpassword']."'";} ?> type="password" name="cadpassword" id="cadpassword" placeholder="Digite sua senha" >
            <span class="erro"><?php echo $errosenha; ?></span>

            <label class="labelconfsenha" id="labelconfsenha">Confirme sua senha</label>
            <input <?php if(!empty($erroConfirmeSenha)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['confirme_password'])){echo "value = '".$_POST['confirme_password']."'";} ?> type="password" name="confirme_password" id="cadconfsenha" placeholder="Confirme sua senha">
            <span class="erro"> <?php echo $erroConfirmeSenha; ?> </span>
            <div class="check_login"> <input type="checkbox" onclick="exibeSenhaCad()" name="check_login" id="check_senha"> Mostrar Senha</div>

            <button class="botao_cancelar" onclick = "cancelar(); return false">Cancelar</button>
            <button class="botao_cadastrar" name="cadastrar">Cadastrar</button>
        </form>
    </div>
</body>
</html>