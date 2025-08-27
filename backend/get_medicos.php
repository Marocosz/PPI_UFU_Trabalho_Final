<?php
// ARQUIVO NOVO

require_once 'conexao.php';
header('Content-Type: application/json');

$especialidade = $_GET['especialidade'] ?? '';

if (empty($especialidade)) {
    echo json_encode([]);
    exit;
}

try {
    $pdo = mysqlConnect();
    $sql = "SELECT Codigo AS id, Nome AS nome FROM Medico WHERE Especialidade = ? ORDER BY Nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especialidade]);
    $medicos = $stmt->fetchAll();
    echo json_encode($medicos);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([]);
}
?>