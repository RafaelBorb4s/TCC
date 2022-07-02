<?php
session_start();
include_once("../conexao.php");

$nome_usuario = strtolower($_SESSION['usuario']);
$erroemail = "";


if(!$nome_usuario){
    header("Location: ../index.php");
}else{
    $sql = "SELECT * FROM `usuarios` WHERE usuario = '$nome_usuario'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
}

if(isset ($_POST['email'])){
    $new_email = strtolower($_POST['email']);
    $id = $linha['id'];

    //Validação E-mail
    if($new_email == strtolower($linha['email'])){
        $erroemail = "Esse e-mail já está cadastrado no nosso banco de dados!";
    }else{
        $sql_update = "UPDATE `usuarios` SET `email`='$new_email' WHERE id = '$id'";
        $resultado_update = mysqli_query($conexao, $sql_update);
        if(mysqli_affected_rows($conexao)){
            header("Location: ../index.php");
        }else{
            header("Location: ../paginas/editar_perfil.php");
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
        <div class="active"><a class="active" href="../paginas_edit/editar_email.php">Editar E-mail</a></div>
        <div><a href="../paginas_edit/editar_senha.php">Editar Senha</a></div>
    </div>
    <form class="form_perfil" method="post">
        <input type="hidden" id="" name="id" value="<?php echo $linha['id']; ?>">

        <label class="labelemail" id="labelemail">E-mail</label>
        <input <?php if(!empty($erroemail)){echo "class = 'invalido'";} ?> value=<?php echo $linha['email'];?> type="email" name="email" id="cademail" placeholder="Digite Seu e-mail" autocomplete="off" >
        <span class="erro"> <?php echo $erroemail; ?></span>
        <input type="submit" id="btn_editar" value="EDITAR">

    </form>
</body>