<?php
require_once 'check_auth.php';
require_once 'conexao.php';
checkAuth();
header('Content-Type: application/json');

try {
    $pdo = mysqlConnect();
    // Adicionada a coluna "UltimoLogin" na consulta SQL
    $sql = "SELECT Nome, Email, EstadoCivil, DataNascimento, Funcao, UltimoLogin FROM Funcionario ORDER BY Nome";
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([]);
}
?>