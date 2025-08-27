<?php
// ARQUIVO NOVO

require_once 'check_auth.php';
require_once 'conexao.php';
checkAuth();
header('Content-Type: application/json');

try {
    $pdo = mysqlConnect();
    $sql = "SELECT Nome, Email, Telefone, Mensagem, Datahora FROM Contato ORDER BY Datahora DESC";
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([]);
}
?>