<?php

    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = '';
    $dbName = 'ciet';


    $conexao = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // if($conexao->connect_errno){
    //     echo 'Erro na conexão com o banco de dados ' . $dbName;
    // }
    // else{
    //     echo 'Conexão feita com sucesso com o banco de dados ' . $dbName;
    // }

?>