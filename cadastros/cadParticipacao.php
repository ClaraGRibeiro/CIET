<?php
    if(isset($_POST['enviar'])){
        include('../bd/config.php');

        $cpf = $_POST['cpf'];
        $tipoAtiv = $_POST['tipo'];
        $codAtiv = $_POST['cod'];
        $palestrante = $_POST['palestrante'];
        $inscricao = $_POST['inscricao'];
        $pagamento = $_POST['pagamento'];
        $titulo = $_POST['titulo'];
        $linkCertif = $_POST['certif'];

        mysqli_query($conexao, "INSERT INTO participacao(cpf, tipoAtiv, codAtiv, palestrante, inscricao, pagamento, titulo, linkCertif)
        VALUES ('$cpf', '$tipoAtiv', '$codAtiv', '$palestrante', '$inscricao', '$pagamento', '$titulo', '$linkCertif')");

        if($palestrante == 's'){
            if(($_POST['fotoLink'] == '' || $_POST['fotoLink'] == NULL) || ($_POST['vulgo'] == '' || $_POST['vulgo'] == NULL) || ($_POST['ies'] == '' || $_POST['ies'] == NULL)){
                echo '<p class="atencao">Se a pessoa for palestrante, os dados referentes a ela devem ser preenchidos!</p>';
            } else{
                $fotoLink = $_POST['fotoLink'];
                $vulgo = $_POST['vulgo'];
                $ies = $_POST['ies'];
                mysqli_query($conexao, "INSERT INTO palestrante(cpf, fotoLink, vulgo, ies)
                VALUES ('$cpf', '$fotoLink', '$vulgo', '$ies')");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIET - Cadastro da Participação</title>
    <link rel="stylesheet" href="../style/index.css">
</head>
<body>
    <?php
        require_once('../componentes/header.html');
    ?>
<h1>CIET</h1>
<h2>Cadastro da Participação</h2>
<form action="cadParticipacao.php" method="post">
    <label for="cpf">Digite o CPF da pessoa</label><br>
    <input type="text" placeholder="ex.: 12345678910" name="cpf" id="cpf" required>
    <br><br>
    <select name="tipo" id="tipo" required>
        <option value="" selected disabled>Selecione o tipo da atividade</option>
        <option value="1">Palestra</option>
        <option value="2">Painel</option>
    </select>
    <br><br>
    <label for="cod">Digite o código da atividade</label><br>
    <input type="text" placeholder="ex.: 31" name="cod" id="cod" required>
    <br><br>
    <label for="">Tipo de Incrição</label><br>
    <input type="radio" name="inscricao" value="s" id="sI">
    <label for="sI">Inscrito</label><br>
    <input type="radio" name="inscricao" value="n" id="nI">
    <label for="nI">Não inscrito</label>
    <br><br>
    <label for="">Tipo de Pagamento</label><br>
    <input type="radio" name="pagamento" value="1" id="avis">
    <label for="avis">À vista</label><br>
    <input type="radio" name="pagamento" value="2" id="isen">
    <label for="isen">Isento</label><br>
    <input type="radio" name="pagamento" value="3" id="parc">
    <label for="parc">Parcelado</label>
    <br><br>
    <select name="titulo" id="titulo" required>
        <option value="" selected disabled>Selecione o título da pessoa</option>
        <option value="1">Convidado</option>
        <option value="2">Ouvinte</option>
    </select>
    <br><br>
    <label for="certif">Digite o link do certificado</label><br>
    <input type="text" placeholder="ex.: https:/drive/certificadoAna.com" name="certif" id="certif" required>
    <br><br>
    <label for="">Palestrante</label><br>
    <input type="radio" name="palestrante" value="s" id="sP">
    <label for="sP">Sim</label><br>
    <input type="radio" name="palestrante" value="n" id="nP">
    <label for="nP">Não</label>
    <br><br>
    <hr>
    <p>Caso for palestrante, adicione mais estes dados para promoção do evento.</p><br>
    <label for="fotoLink">Digite link da foto do palestrante</label><br>
    <input type="text" placeholder="ex.: https:/drive/fotoAna.com" name="fotoLink" id="fotoLink">
    <br><br>
    <label for="vulgo">Digite o vulgo do palestrante</label><br>
    <input type="text" placeholder="ex.: Aninha" name="vulgo" id="vulgo">
    <br><br>
    <label for="ies">Digite o IES do palestrante</label><br>
    <input type="text" placeholder="ex.: UFSCar" name="ies" id="ies">
    <br><br>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
</form>

    <?php
        require_once('../componentes/footer.html')
    ?>
</body>
</html>