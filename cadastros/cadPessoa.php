<?php
    if(isset($_POST['enviar'])){
        include('../bd/config.php');

        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $rg = $_POST['rg'];
        $email = $_POST['email'];
        $uf = $_POST['uf'];
        
        mysqli_query($conexao, "INSERT INTO pessoa(cpf, nome, rg, email, uf)
        VALUES ('$cpf', '$nome', '$rg', '$email', '$uf')");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIET - Cadastro da Pessoa</title>
    <link rel="stylesheet" href="../style/index.css">
</head>
<body>
    <?php
        require_once('../componentes/header.html');
    ?>
<h1>CIET</h1>
    <h2>Cadastro da Pessoa</h2>
    <form action="cadPessoa.php" method="post">
        <label for="cpf">Digite seu CPF</label><br>
        <input type="text" placeholder="ex.: 12345678910" name="cpf" id="cpf" required>
        <br><br>
        <label for="nome">Digite seu nome</label><br>
        <input type="text" placeholder="ex.: Ana Almeida Alves" name="nome" id="nome" required>
        <br><br>
        <label for="rg">Digite seu rg</label><br>
        <input type="text" placeholder="ex.: sspmg10203040" name="rg" id="rg" required>
        <br><br>
        <label for="email">Digite seu email</label><br>
        <input type="email" placeholder="ex.: ana2as@gmail.com" name="email" id="email" required>
        <br><br>
        <select name="uf" id="uf" required>
            <option value="" selected disabled>Selecione sua UF</option>
            <option value="mg">MG</option>
            <option value="sp">SP</option>
            <option value="ba">BA</option>
        </select>
        <br><br>
        <br>
        <button type="submit" name="enviar" id="enviar">Enviar</button>
    </form>
    <?php
        require_once('../componentes/footer.html')
    ?>
</body>
</html>