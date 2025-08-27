<?php
// ARQUIVO NOVO

require_once 'conexao.php';
header('Content-Type: application/json');

try {
    $pdo = mysqlConnect();
    $sql = "SELECT DISTINCT Especialidade FROM Medico ORDER BY Especialidade";
    $stmt = $pdo->query($sql);
    $especialidades = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($especialidades);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([]);
}
?>