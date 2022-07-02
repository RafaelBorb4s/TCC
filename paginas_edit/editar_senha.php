<?php
session_start();
include_once("../conexao.php");

$nome_usuario = strtolower($_SESSION['usuario']);
$erroSenhaAtual = "";
$errosenha = "";
$erroConfirmeSenha = "";

if(!$nome_usuario){
    header("Location: ../index.php");
}else{
    $sql = "SELECT * FROM `usuarios` WHERE usuario = '$nome_usuario'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
}

if(isset ($_POST['Atualpassword'])){
    $id = $linha['id'];
    
    $senha_atual = $_POST['Atualpassword'];
    $senha_atual_crip = sha1($senha_atual);

    $new_senha = $_POST['edpassword'];
    $new_conf_senha = $_POST['confirme_ed_password'];
    $id = $linha['id'];

    //Validação senha
    if($new_senha != $new_conf_senha){
        $erroConfirmeSenha = "Informe duas senhas iguais!";
    }elseif($senha_atual_crip != $linha['senha']){
        $erroSenhaAtual = "Por favor informe sua senha atual correntamente!";
    }else{
        $senha = limpaPost($_POST['edpassword']);
        if(strlen($senha) < 8){
            $errosenha = "A senha precisa ter no mínimo 8 dígitos!";
        }else{
            $senha_crip = sha1($senha);
            $sql_update = "UPDATE `usuarios` SET `senha`='$senha_crip' WHERE id = '$id'";
            $resultado_update = mysqli_query($conexao, $sql_update);
            if(mysqli_affected_rows($conexao)){
                header("Location: ../index.php");
            }else{
                header("Location: ../paginas/editar_perfil.php");
            }
        }
        
    }  
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <script src="../app.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../style_responsive.css">
    <link rel="shortcut icon" href="../img/icon.svg" type="image/x-icon">
    <title>Editar Perfil</title>
    <a href="../index.php"><img class="logotipo" src="../img/logo.png" alt="logo"></a>
</head>

<body class="editar">
<h1>Comunidade de Ofertas!</h1>
    <div class="grid">
        <div><a href="../index.php">Inicio</a></div>
        <div><a href="../paginas/editar_perfil.php">Editar Usuário</a></div>
        <div><a href="../paginas_edit/editar_email.php">Editar E-mail</a></div>
        <div class="active"><a class="active" href="../paginas_edit/editar_senha.php">Editar Senha</a></div>
    </div>
    
    <form class="form_perfil" method="post">
        <input type="hidden" id="" name="id" value="<?php echo $linha['id']; ?>">

        <label class="labelsenha" id="labelsenha">Informe sua senha atual</label>
        <input <?php if(!empty($erroSenhaAtual)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['Atualpassword'])){echo "value = '".$_POST['Atualpassword']."'";} ?> type="password" name="Atualpassword" id="cadpassword" placeholder="Digite sua senha atual" >
        <span class="erro"><?php echo $erroSenhaAtual; ?></span>

        <label class="labelsenha" id="labelsenha">Nova Senha</label>
        <input <?php if(!empty($errosenha)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['edpassword'])){echo "value = '".$_POST['edpassword']."'";} ?> type="password" name="edpassword" id="edpassword" placeholder="Digite sua nova senha" >
        <span class="erro"><?php echo $errosenha; ?></span>

        <label class="labelconfsenha" id="labelconfsenha">Confirme sua nova senha</label>
        <input <?php if(!empty($erroConfirmeSenha)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['cadconfsenha'])){echo "value = '".$_POST['cadconfsenha']."'";} ?> type="password" name="confirme_ed_password" id="cadconfsenha" placeholder="Confirme sua nova senha">
        <span class="erro"> <?php echo $erroConfirmeSenha; ?> </span>

        <div class="check_login"> <input type="checkbox" onclick="exibeSenhaCad()" name="check_login" id="check_senha"> Mostrar Senha</div>
        <input type="submit" id="btn_editar" value="EDITAR">
    </form>
</body>