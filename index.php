<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIET</title>
    <link rel="stylesheet" href="./style/index.css">
</head>
<body>
    <header>
        <a class="logo" href="index.php">CIET</a>
        <nav class="menu">
            <a href="./cadastros/cadPessoa.php">Cadastrar Pessoa</a>
            <a href="./cadastros/cadAtividade.php">Cadastrar Atividade</a>
            <a href="./cadastros/cadParticipacao.php">Cadastrar Participação</a>
            <a href="./leituras/buscaDados.php">Busca por Dados</a>
        </nav>
    </header>
    <main>
        <h1>Sistema de Agendamento do CIET</h1>
        <p>Aqui você poderá realizar no sistema o cadastro de:</p>
        <ul>
            <li>Pessoas</li>
            <li>Atividade (palestras, paineis...)</li>
            <li>Participações das pessoas cadastradas</li>
        </ul>
        <br><br>
        <p class="atencao">Para isso, clique na opção desejada no menu do cabeçalho acima.</p>
    </main>
    <?php
        require_once('./componentes/footer.html')
    ?>
</body>
</html>