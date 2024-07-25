<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIET - Busca por Dados</title>
    <link rel="stylesheet" href="../style/index.css">
</head>
<body>
    <header>
        <a class="logo" href="../index.php">CIET</a>
        <nav class="menu">
            <a href="../cadastros/cadPessoa.php">Cadastrar Pessoa</a>
            <a href="../cadastros/cadAtividade.php">Cadastrar Atividade</a>
            <a href="../cadastros/cadParticipacao.php">Cadastrar Participação</a>
            <a href="buscaPessoa.php">Busca por Pessoa</a>
        </nav>
    </header>
<h1>CIET</h1>
<h2>Busca por Dados</h2>
<form action="buscaDados.php" method="post">
    <button type="submit" name="busca" id="busca" value="1">Pessoas</button>
    <button type="submit" name="busca" id="busca" value="2">Palestras</button>
    <button type="submit" name="busca" id="busca" value="3">Palestrantes</button>
    <button type="submit" name="busca" id="busca" value="4">Painéis</button>
    <button type="submit" name="busca" id="busca" value="5">Participações</button>
</form>
<br><br>
<?php
    if(isset($_POST['busca'])){
        include('../bd/config.php');

        $busca = $_POST['busca'];

        switch ($busca) {
            case 1:
                $result = mysqli_query($conexao, "SELECT * FROM pessoa");
                if ($result->num_rows > 0) {
                    echo "<table>
                            <thead>
                                <tr>
                                    <td>CPF</td>
                                    <td>Nome</td>
                                    <td>RG</td>
                                    <td>Email</td>
                                    <td>Telefone</td>
                                    <td>UF</td>
                                    <td>Cidade</td>
                                    <td>Logradouro</td>
                                    <td>Número</td>
                                </tr>
                            </thead>
                            <tbody>";
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["cpf"] . "</td>";
                            echo "<td>" . $row["nome"] . "</td>";
                            echo "<td>" . $row["rg"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["telefone"] . "</td>";
                            echo "<td>" . $row["uf"] . "</td>";
                            echo "<td>" . $row["cidade"] . "</td>";
                            echo "<td>" . $row["logradouro"] . "</td>";
                            echo "<td>" . $row["numero"] . "</td>";
                            echo "</tr>";
                        }
                    echo "</tbody></table>";
                } else {
                    echo "<table><tr><td>0 resultados para Pessoas</td></tr></table>";
                }
            break;
            case 2:
                $result = mysqli_query($conexao, "SELECT * FROM palestra");
                if ($result->num_rows > 0) {
                    echo "<table class='tabela'>
                            <thead>
                                <tr>
                                    <td>Código da Palestra</td>
                                    <td>Nome</td>
                                    <td>Categoria</td>
                                    <td>Palestrante(s)</td>
                                </tr>
                            </thead>
                            <tbody>";
                            while($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["codPalestra"] . "</td>";
                                echo "<td>" . $row["nome"] . "</td>";
                                if($row["categ"] == 'p'){echo "<td>Presencial</td>";}
                                else if($row["categ"] == 'v'){echo "<td>Virtual</td>";}
                            }
                            echo "<td>";
                            $result = mysqli_query($conexao, "SELECT palestrante.cpf FROM palestra, palestrante, palpal WHERE palestrante.cpf=palpal.cpf AND palestra.codPalestra=palpal.codPalestra");
                            while($row = mysqli_fetch_array($result)) {///  CORRIGIR
                                echo $row["cpf"] . "<br>";
                            }
                            echo "</td></tr>";
                    echo "</tbody></table>";
                } else {
                    echo "<table><tr><td>0 resultados para Palestras</td></tr></table>";
                }
            break;
            case 3:
                $result = mysqli_query($conexao, "SELECT * FROM palestrante");
                if ($result->num_rows > 0) {
                    echo "<table>
                            <thead>
                                <tr>
                                    <td>CPF</td>
                                    <td>Link da Foto</td>
                                    <td>Vulgo</td>
                                    <td>IES</td>
                                    <td>Palestra</td>
                                </tr>
                            </thead>
                            <tbody>";
                            while($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["cpf"] . "</td>";
                                echo "<td>" . $row["fotoLink"] . "</td>";
                                echo "<td>" . $row["vulgo"] . "</td>";
                                echo "<td>" . $row["ies"] . "</td>";
                            }
                            echo "<td>";
                            $result = mysqli_query($conexao, "SELECT palestra.codPalestra FROM palestra, palestrante, palpal WHERE palestrante.cpf=palpal.cpf AND palestra.codPalestra=palpal.codPalestra");
                            while($row = mysqli_fetch_array($result)) {///  CORRIGIR
                                echo $row["codPalestra"] . "<br>";
                            }
                            echo "</td></tr>";
                    echo "</tbody></table>";
                } else {
                    echo "<table><tr><td>0 resultados para Palestrantes</td></tr></table>";
                }
            break;
            case 4:
                $result = mysqli_query($conexao, "SELECT * FROM painel");
                if ($result->num_rows > 0) {
                    echo "<table>
                            <thead>
                                <tr>
                                    <td>Código do Painel</td>
                                    <td>Nome</td>
                                </tr>
                            </thead>
                            <tbody>";
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["codPainel"] . "</td>";
                            echo "<td>" . $row["nome"] . "</td>";
                            echo "</tr>";
                        }
                    echo "</tbody></table>";
                } else {
                    echo "<table><tr><td>0 resultados para Painéis</td></tr></table>";
                }
            break;
            case 5:
                $result = mysqli_query($conexao, "SELECT * FROM participacao");
                if ($result->num_rows > 0) {
                    echo "<table>
                            <thead>
                                <tr>
                                    <td>CPF</td>
                                    <td>Tipo de Atividade</td>
                                    <td>Código da Atividade</td>
                                    <td>Palestrante</td>
                                    <td>Tipo de Inscrição</td>
                                    <td>Tipo de Pagamento</td>
                                    <td>Título</td>
                                    <td>Link do Certificado</td>
                                </tr>
                            </thead>
                            <tbody>";
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["cpf"] . "</td>";
                            if($row["tipoAtiv"] == '1'){echo "<td>Palestra</td>";}
                            else if($row["tipoAtiv"] == '2'){echo "<td>Painel</td>";}
                            echo "<td>" . $row["codAtiv"] . "</td>";
                            if($row["palestrante"] == 's'){echo "<td>Sim</td>";}
                            else if($row["palestrante"] == 'n'){echo "<td>Não</td>";}

                            if($row["inscricao"] == 's'){echo "<td>Inscrito</td>";}
                            else if($row["inscricao"] == 'n'){echo "<td>Não Inscrito</td>";}

                            if($row["pagamento"] == '1'){echo "<td>À vista</td>";}
                            else if($row["pagamento"] == '2'){echo "<td>Isento</td>";}
                            else if($row["pagamento"] == '2'){echo "<td>parcelado</td>";}

                            if($row["titulo"] == '1'){echo "<td>Convidado</td>";}
                            else if($row["titulo"] == '2'){echo "<td>Ouvinte</td>";}
                            echo "<td><a class='link' href='" . $row["linkCertif"] . "' target='_blank'>" . $row["linkCertif"] . "</a></td>";
                            echo "</tr>";
                        }
                    echo "</tbody></table>";
                } else {
                    echo "<table><tr><td>0 resultados para Participações</td></tr></table>";
                }
            break;
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
        require_once('../componentes/footer.html')
    ?>
</body>
</html>