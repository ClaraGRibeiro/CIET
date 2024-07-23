<?php
    if(isset($_POST['enviar'])){
        include('../bd/config.php');

        $tipoAtiv = $_POST['tipo'];
        $codAtiv = $_POST['cod'];
        mysqli_query($conexao, "INSERT INTO atividade(tipoAtiv, codAtiv)
        VALUES ('$tipoAtiv', '$codAtiv')");


        $nome = $_POST['nome'];
        $categ = $_POST['categ'];


        if($tipoAtiv == 1){
            mysqli_query($conexao, "INSERT INTO palestra(codPalestra, nome, categ)
            VALUES ('$codAtiv', '$nome', '$categ')");
        }
        if($tipoAtiv == 2){
            mysqli_query($conexao, "INSERT INTO painel(codPainel, nome)
            VALUES ('$codAtiv', '$nome')");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIET - Cadastro da Atividade</title>
    <link rel="stylesheet" href="../style/index.css">
</head>
<body>
    <?php
        require_once('../componentes/header.html');
    ?>
<h1>CIET</h1>
<h2>Cadastro da Atividade</h2>
<form action="cadAtividade.php" method="post">
    <select name="tipo" id="tipo" required>
        <option value="" selected disabled>Selecione o tipo da atividade</option>
        <option value="1">Palestra</option>
        <option value="2">Painel</option>
    </select>
    <br><br>
    <label for="cod">Digite o código da atividade</label><br>
    <input type="text" placeholder="ex.: 31" name="cod" id="cod" required>
    <br><br>
    <label for="nome">Digite o nome da atividade</label><br>
    <input type="text" placeholder="ex.: gamificação na educação" name="nome" id="nome" required>
    <br><br>
    <label for="">Categoria da Atividade</label><br>
    <input type="radio" name="categ" value="p" id="p">
    <label for="p">Presencial</label><br>
    <input type="radio" name="categ" value="v" id="v">
    <label for="v">Virtual</label>
    <br><br>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
</form>

<?php
        require_once('../componentes/footer.html')
    ?>
</body>
</html>