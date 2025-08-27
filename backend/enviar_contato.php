<?php
require_once 'conexao.php';
session_start();

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

if (empty($nome) || empty($email) || empty($mensagem)) {
    header('Location: ../contato.html?status=error');
    exit;
}

try {
    $pdo = mysqlConnect();
    $sql = "INSERT INTO Contato (Nome, Email, Telefone, Mensagem) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $telefone, $mensagem]);
    header('Location: ../contato.html?status=success');
    exit();
} catch (Exception $e) {
    header('Location: ../contato.html?status=error');
    exit();
}
?>