<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIET - Busca por Pessoa</title>
    <link rel="stylesheet" href="../style/index.css">
</head>
<body>
    <header>
        <a class="logo" href="../index.php">CIET</a>
        <nav class="menu">
            <a href="../cadastros/cadPessoa.php">Cadastrar Pessoa</a>
            <a href="../cadastros/cadAtividade.php">Cadastrar Atividade</a>
            <a href="../cadastros/cadParticipacao.php">Cadastrar Participação</a>
            <a href="buscaDados.php">Busca por Dados</a>
        </nav>
    </header>
<h1>CIET</h1>
<h2>Busca por Pessoa</h2>
<form action="buscaPessoa.php" method="post">
    <select name="busca" id="busca" required>
        <option value="" selected disabled>Selecione a busca por Pessoa</option>
        <?php
        include('../bd/config.php');
        $result = mysqli_query($conexao, "SELECT cpf, nome FROM pessoa ORDER BY nome");
        while($row = mysqli_fetch_array($result)) {
            echo "<option value=" . $row["cpf"] . ">" . $row["nome"] . " (". $row["cpf"] .")</option>";
        }
        ?>
    </select>
    <button type="submit" name="enviar" id="enviar">Enviar</button>
</form>
<br><br>

<?php
    if(isset($_POST['enviar'])){
        $busca = $_POST['busca'];

        $result = mysqli_query($conexao, 
        "SELECT 
            pess.cpf,
            pess.nome,
            pess.email,
            part.palestrante,
            CASE
                WHEN part.palestrante = 's' THEN (SELECT pale.vulgo FROM Palestrante pale WHERE pale.cpf = pess.cpf)
                ELSE '-'
            END AS 'vulgo',
            part.linkCertif,
            part.tipoAtiv,
            CASE
                WHEN part.tipoAtiv = '1' THEN (SELECT pale.nome FROM Palestra pale WHERE pale.codPalestra = part.codAtiv)
                WHEN part.tipoAtiv = '2' THEN (SELECT pain.nome FROM Painel pain WHERE pain.codPainel = part.codAtiv)
                ELSE '-'
            END AS 'nomeAtiv',
            CASE
                WHEN part.tipoAtiv = '1' THEN (SELECT pale.categ FROM Palestra pale WHERE pale.codPalestra = part.codAtiv)
                ELSE '-'
            END AS 'categ'
            FROM Pessoa pess, Participacao part
            WHERE pess.cpf = " . $busca . " AND part.cpf = pess.cpf"
        );
        if($result){
            echo "
                <table>
                    <thead>
                        <tr>
                            <td>CPF</td>
                            <td>Nome</td>
                            <td>Email</td>
                            <td>Palestrante</td>
                            <td>Vulgo</td>
                            <td>Certificado</td>
                            <td>Tipo da Atividade</td>
                            <td>Nome da Atividade</td>
                            <td>Categoria da Atividade</td>
                        </tr>
                    </thead>
                    <tbody>
            ";
            
            while($row = mysqli_fetch_array($result)) {
                echo "
                                <tr>
                                    <td>" . $row["cpf"] . "</td>
                                    <td>" . $row["nome"] . "</td>
                                    <td>" . $row["email"] . "</td>
                ";
                                if($row["palestrante"] == 's'){echo "<td>Sim</td>";}
                                else if($row["palestrante"] == 'n'){echo "<td>Não</td>";}
                echo "
                                <td>" . $row["vulgo"] . "</td>
                                <td>" . $row["linkCertif"] . "</td>
                ";
                                if($row["tipoAtiv"] == '1'){echo "<td>Palestra</td>";}
                                else if($row["tipoAtiv"] == '2'){echo "<td>Painel</td>";}
                echo "
                                <td>" . $row["nomeAtiv"] . "</td>
                ";
                                if($row["categ"] == 'p'){echo "<td>Presencial</td>";}
                                else if($row["categ"] == 'v'){echo "<td>Virtual</td>";}
                                else{echo "<td>" . $row["categ"] . "</td>";}
                echo "
                            </tr>";
                }
            echo "
                    </tbody>
                </table>
            ";
        } else{
            echo "<table><tr><td>0 resultados para Participações referente ao CPF ". $busca ."</td></tr></table>";
        }
    }
?>
<style>
    table{
        margin: 0 auto;
    }
    td{
        padding: 10px;
    }
    thead{
        color:white;
        background-color:grey;
    }
</style>
    <?php
        require_once('../componentes/footer.html');
    ?>
</body>
</html>