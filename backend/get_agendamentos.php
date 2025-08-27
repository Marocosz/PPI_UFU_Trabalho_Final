<?php
// ARQUIVO NOVO

require_once 'check_auth.php';
require_once 'conexao.php';
checkAuth();
header('Content-Type: application/json');

try {
    $pdo = mysqlConnect();
    $sql = <<<SQL
        SELECT a.Datahora, m.Nome AS NomeMedico, p.Nome AS NomePaciente
        FROM Agendamento a
        JOIN Medico m ON a.CodigoMedico = m.Codigo
        JOIN Paciente p ON a.CodigoPaciente = p.Codigo
        ORDER BY a.Datahora DESC
    SQL;
    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([]);
}
?>