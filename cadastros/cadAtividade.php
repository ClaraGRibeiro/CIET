<?php
    include('../bd/config.php');
    if(isset($_POST['cadastrar'])){

        $codAtiv = $_POST['cod'];
        $tipoAtiv = $_POST['tipoAtiv'];
        mysqli_query($conexao, "INSERT INTO atividade(tipoAtiv, codAtiv)
        VALUES ('$tipoAtiv', '$codAtiv')");

        $nome = $_POST['nome'];

        if($tipoAtiv == 1){
            $categ = $_POST['categ'];
            $cpf = $_POST['cpf'];
            mysqli_query($conexao, "INSERT INTO palestra(codPalestra, nome, categ)
            VALUES ('$codAtiv', '$nome', '$categ')");
            mysqli_query($conexao, "INSERT INTO palpal(cpf, codPalestra)
            VALUES ('$cpf', '$codAtiv')");
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
    <button type="submit" name="escolherTipo" id="escolherTipo">Escolher</button>
</form>
<br><br>
<?php
if (isset($_POST['escolherTipo'])){
    $tipoAtiv = $_POST['tipo'];
    if($tipoAtiv == '1'){$tituloForm = 'Palestra';}
    else if($tipoAtiv == '2'){$tituloForm = 'Painel';}
    echo "
        <hr><br><br>
        <h3>Cadastro de $tituloForm</h3>
        <form action=\"cadAtividade.php\" method=\"post\">
            <input type=\"radio\" name=\"tipoAtiv\" value='$tipoAtiv' id=\"tipoAtiv\" checked enable>
            <label for=\"tipoAtiv\">$tituloForm</label><br><br>
            <label for=\"cod\">Digite o código da atividade</label><br>
            <input type=\"text\" placeholder=\"ex.: 31\" name=\"cod\" id=\"cod\" required>
            <br><br>
            <label for=\"nome\">Digite o nome da atividade</label><br>
            <input type=\"text\" placeholder=\"ex.: gamificação na educação\" name=\"nome\" id=\"nome\" required>
    ";
    if($tipoAtiv == '1'){
        echo"        
            <br><br>
            <label for=\"\">Categoria da Atividade</label><br>
            <input type=\"radio\" name=\"categ\" value=\"p\" id=\"p\">
            <label for=\"p\">Presencial</label><br>
            <input type=\"radio\" name=\"categ\" value=\"v\" id=\"v\">
            <label for=\"v\">Virtual</label>
            <br><br>
            <select name='cpf' id='cpf' required>
                <option value='' selected disabled>Selecione o Palestrante</option>
        ";
                $result = mysqli_query($conexao, "SELECT pa.cpf, pe.nome FROM palestrante pa, pessoa pe WHERE pa.cpf = pe.cpf");
                while($row = mysqli_fetch_array($result)) {
                    echo "<option value=" . $row["cpf"] . ">" . $row["nome"] . " (". $row["cpf"] .")</option>";
                }
        echo"
            </select>
        ";
    }
    echo "
            <br><br>
            <button type=\"submit\" name=\"cadastrar\" id=\"cadastrar\">Cadastrar $tituloForm</button>
        </form>
    ";
}
?>
<?php
        require_once('../componentes/footer.html')
    ?>
</body>
</html>