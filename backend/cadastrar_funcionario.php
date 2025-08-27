<?php
require_once 'check_auth.php';
require_once 'conexao.php';
checkAuth();

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$estadoCivil = $_POST['estadoCivil'] ?? '';
$dataNascimento = $_POST['dataNascimento'] ?? '';
$funcao = $_POST['funcao'] ?? '';

if (empty($nome) || empty($email) || empty($senha) || empty($funcao)) {
    header('Location: ../restrito/cadastro.php?status=error&msg=PreenchaTodosCampos');
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $pdo = mysqlConnect();
    $sql = "INSERT INTO Funcionario (Nome, Email, Senhahash, EstadoCivil, DataNascimento, Funcao) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $senhaHash, $estadoCivil, $dataNascimento, $funcao]);
    
    header('Location: ../restrito/cadastro.php?status=success_func');
    exit();

} catch (PDOException $e) {
    $errorCode = 'ErroDesconhecido';
    if ($e->errorInfo[1] == 1062) { // Código de erro para entrada duplicada (email)
        $errorCode = 'EmailDuplicado';
    }
    header('Location: ../restrito/cadastro.php?status=error&msg=' . $errorCode);
    exit();
}
?>