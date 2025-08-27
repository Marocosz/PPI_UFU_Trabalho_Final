<?php
require_once 'conexao.php';
session_start();

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
// ... (recebe todos os outros campos do $_POST)

if (empty($nome) || empty($email) || empty($id_medico) || empty($data_hora)) {
    header('Location: ../agendamento.html?status=error');
    exit;
}

$pdo = mysqlConnect();
try {
    $pdo->beginTransaction();
    // ... (toda a lógica de inserir paciente e agendamento) ...
    $pdo->commit();
    header('Location: ../agendamento.html?status=success');
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    header('Location: ../agendamento.html?status=error');
    exit();
}
?>