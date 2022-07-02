<?php
session_start();
include_once("../conexao.php");

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    header("Location: ../index.php");
}
$sql = "SELECT * FROM `publicacoes` WHERE id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <script src="../app.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../img/icon.svg" type="image/x-icon">
    <title>Editar</title>
    <div class="logotipo"><a href="../index.php"><img src="../img/logo.png" alt="logo"></a></div>
</head>
<body class="editar">
<h1 id="edit_h1">Editar</h1>
    <div class="cad_editar">
        <form method="POST" class="form_edit" action="processa_edit.php">
            <?php $erroValor = "";?>
            <input type="hidden" id="" name="id" value="<?php echo $linha['id']; ?>"><br>

            <label id="edit_label" for="">Descrição</label>
            <input <?php if(!empty($erroProduto)){echo "class = 'invalido' ";} ?> type="text" id="edit" name="Desc" value="<?php echo $linha['produto']; ?>" required>

            <label id="edit_label" for="">Valor<br><br>R$</label>
            <input <?php if(!empty($erroProduto)){echo "class = 'invalido' ";} ?> type="text" id="edit_reais" name="reais" value="<?php echo $linha['valor']; ?>" required> <br>
            <span class="erro"><?php echo $erroValor; ?></span>

            <label id="edit_label" for="">Link</label>
            <input <?php if(!empty($erroProduto)){echo "class = 'invalido' ";} ?> type="url" id="edit" name="Link" value="<?php echo $linha['link']; ?>" required>

            <label id="edit_label" for="">Categorias:</label>
            <select id="edit" name="Categoria" required>
                <option value="acessorios">Acessórios</option>
                <option value="alto_falante">Alto Falante</option>
                <option value="armazenamento">Armazenamento</option>
                <option value="cadeira">Cadeira</option>
                <option value="console">Console</option>
                <option value="fone">Fone</option>
                <option value="fonte">Fonte</option>
                <option value="gabinete">Gabinete</option>
                <option value="headset">Headset</option>
                <option value="jogos">Jogos</option>
                <option value="kit_upgrade">Kit Upgrade</option>
                <option value="Memoria_Ram">Memoria RAM</option>
                <option value="mesa">Mesa</option>
                <option value="microfone">Microfone</option>
                <option value="monitor">Monitor</option>
                <option value="mouse">Mouse/MousePad</option>
                <option value="pc_notebook">PC/Notebook</option>
                <option value="placa_de_video">Placa de Video</option>
                <option value="placa_mae">Placa Mãe</option>
                <option value="processador">Processador</option>
                <option value="refrigeração">Refrigeração</option>
                <option value="smartphone">Smartphone</option>
                <option value="teclado">Teclado</option>
                <option value="televisão">Televisão</option>
            </select>
            <input type="submit" id="btn_editar" value="EDITAR">
        </form>
    </div>
</body>
</html>