<?php
    if(isset($_POST['enviar'])){
        include('../bd/config.php');

        $cpf = $_POST['cpf'];
        $fotoLink = $_POST['fotoLink'];
        $vulgo = $_POST['vulgo'];
        $ies = $_POST['ies'];
        
        mysqli_query($conexao, "INSERT INTO palestrante(cpf, fotoLink, vulgo, ies)
        VALUES ('$cpf', '$fotoLink', '$vulgo', '$ies')");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIET - Cadastro do Palestrante</title>
    <link rel="stylesheet" href="../style/index.css">
</head>
<body>
    <?php
        require_once('../componentes/header.html');
    ?>
<h1>CIET</h1>
    <h2>Cadastro da Palestrante</h2>
    <form action="cadPalestrante.php" method="post">
        <select name='cpf' id='cpf' required>
            <option value='' selected disabled>Selecione a Pessoa</option>
            <?php
            include('../bd/config.php');
            $result = mysqli_query($conexao, "SELECT cpf, nome FROM pessoa");
            while($row = mysqli_fetch_array($result)) {
                echo "<option value=" . $row["cpf"] . ">" . $row["nome"] . " (". $row["cpf"] .")</option>";
            }
            ?>
        </select>
        <br><br>
        <label for='fotoLink'>Digite link da foto do palestrante</label><br>
        <input type='text' placeholder='ex.: https:/drive/fotoAna.com' name='fotoLink' id='fotoLink'>
        <br><br>
        <label for='vulgo'>Digite o vulgo do palestrante</label><br>
        <input type='text' placeholder='ex.: Aninha' name='vulgo' id='vulgo'>
        <br><br>
        <label for='ies'>Digite o IES do palestrante</label><br>
        <input type='text' placeholder='ex.: UFSCar' name='ies' id='ies'>
        <br><br>
        <button type="submit" name="enviar" id="enviar">Enviar</button>
    </form>
    <?php
        require_once('../componentes/footer.html')
    ?>
</body>
</html>