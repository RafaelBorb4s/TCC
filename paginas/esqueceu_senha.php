<?php
include_once("../conexao.php");

$erroemail = "";
$var = false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Envia para o e-mail do usuario
    $novaSenha = substr(sha1(time()), 0, 8);
    //Salva no Banco de Dados
    $novaSenhaCrip = sha1($novaSenha);

    //Validação E-mail
    if(empty($_POST['email'])){
        $erroemail = "Por favor, informe um e-mail!";
    }else{
        $email = limpaPost($_POST['email']);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erroemail = "E-mail inválido!";
        }
        //verifica se tem E-mail
        $query = " SELECT * FROM `usuarios` WHERE email = '$email'";
        $result = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($result);
        if($row == 0){
            $erroemail = "Não foi encontrado esse e-mail no banco de dados";
        }
        if($row == 1){
            if(mail($email, "Solicitação de Nova senha!", "Sua nova senha gerada é: ".$novaSenha)){
                $var = true;
                $sql = "UPDATE `usuarios` SET senha='$novaSenhaCrip' WHERE email = '$email'";
                $resultado = mysqli_query($conexao, $sql);
            }
        }
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
        <h1>Recuperar Senha</h1>
        <form id="frm1" method="post">

            <?php if($var){echo "<div class=".'sucesso'."><p>E-mail envido com sucesso!</p></div>";} ?>

            <label class="labelemail" id="labelemail">E-mail</label>
            <input <?php if(!empty($erroemail)){echo "class = 'invalido'";} ?> <?php if(isset($_POST['email'])){echo "value = '".$_POST['email']."'";} ?> type="email" name="email" id="cademail" placeholder="Digite seu e-mail cadastrado" autocomplete="off" >
            <span class="erro"> <?php echo $erroemail; ?></span>

            <button class="botao_cancelar" onclick = "cancelar(); return false">Cancelar</button>
            <button class="botao_cadastrar" name="env">Enviar</button>
        </form>
    </div>
</body>
</html>