<?php
    include('../bd/config.php');
    if(isset($_POST['enviar'])){

        $cpf = $_POST['cpf'];
        $tipoAtiv = substr($_POST['cod'], 0, 1);
        $codAtiv = substr($_POST['cod'], 1, (strlen($_POST['cod'])-1));
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
<form action="cadParticipacao.php" method="post" id="cadPart">
    
    <select name="cpf" id="cpf" required>
        <option value="" selected disabled>Selecione a Pessoa</option>
        <?php
        $result = mysqli_query($conexao, "SELECT cpf, nome FROM pessoa");
        while($row = mysqli_fetch_array($result)) {
            echo "<option value=" . $row["cpf"] . ">" . $row["nome"] . " (". $row["cpf"] .")</option>";
        }
        ?>
    </select>
    <br><br>
    <select name="cod" id="cod">
        <option value="" selected disabled>Selecione a Atividade</option>
        <?php
        $result = mysqli_query($conexao, "SELECT codPalestra AS 'cod', nome FROM palestra");
        while($row = mysqli_fetch_array($result)) {
            echo "<option value='1" . $row["cod"] . "'>Palestra - " . $row["nome"] . " (". $row["cod"] .")</option>";
        }
        $result = mysqli_query($conexao, "SELECT codPainel AS 'cod', nome FROM painel");
        while($row = mysqli_fetch_array($result)) {
            echo "<option value='2" . $row["cod"] . "'>Painel - " . $row["nome"] . " (". $row["cod"] .")</option>";
        }
        ?>
    </select>
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