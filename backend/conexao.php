<?php
// ARQUIVO MODIFICADO (Sua versão com PDO)

function mysqlConnect()
{
    $db_host = "sql208.infinityfree.com";
    $db_username = "if0_39256847";
    $db_password = "Racb2004";
    $db_name = "if0_39256847_Trabalho_Final_db";

    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, 
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
        $pdo->exec("SET time_zone = '-03:00'");
        return $pdo;
    } 
    catch (Exception $e) {
        exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
    }
}
date_default_timezone_set('America/Sao_Paulo');
?>