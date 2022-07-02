<?php
session_start();
include_once("../conexao.php");

$nome_usuario = strtolower($_SESSION['usuario']);
$errousuario = "";

if(!$nome_usuario){
    header("Location: ../index.php");
}else{
    $sql = "SELECT * FROM `usuarios` WHERE usuario = '$nome_usuario'";
    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado);
}

if(isset ($_POST['usuario'])){
    $new_name = strtolower($_POST['usuario']);
    $id = $linha['id'];

    $sql5 = mysqli_query($conexao,"SELECT * FROM `usuarios` WHERE usuario = '$new_name' ");
    $linha5 = mysqli_num_rows($sql5);

    //Validação Usuário
    if($linha5 > 0){
        $errousuario = "Nome de Usuário ja cadastrado";
    }else{
        $sql_update = "UPDATE `usuarios` SET `usuario`='$new_name' WHERE id = '$id'";
        $resultado_update = mysqli_query($conexao, $sql_update);

        $sql_update_nome_publi = "UPDATE `publicacoes` SET `nome`='$new_name' WHERE nome = '$nome_usuario'";
        $resultado_update_publi = mysqli_query($conexao, $sql_update_nome_publi);

        if(mysqli_affected_rows($conexao)){
            session_unset();
            header("Location: login.php");
        }else{
            header("Location: editar_perfil.php");
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

<body class="perfil">
    <h1>Comunidade de Ofertas!</h1>

    <div class="grid">
        <div><a href="../index.php">Inicio</a></div>
        <div class="active"><a class="active" href="">Editar Usuário</a></div>
        <div><a href="../paginas_edit/editar_email.php">Editar E-mail</a></div>
        <div><a href="../paginas_edit/editar_senha.php">Editar Senha</a></div>
    </div>
    
    <form class="form_perfil" method="post">
        <input type="hidden" id="" name="id" value="<?php echo $linha['id']; ?>">

        <label class="labelusuario" id="labelusuario">Alterar nome do usuário</label>
        <input <?php if(!empty($errousuario)){echo "class = 'invalido'";} ?> value=<?php echo $linha['usuario'];?> type="usuario" name="usuario" id="cadusuario" placeholder="Digite seu usuario" autocomplete="off" >
        <span class="erro"> <?php echo $errousuario; ?> </span>
        <input type="submit" id="btn_editar" value="EDITAR">
        
    </form>
</body>