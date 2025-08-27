<?php
require_once 'check_auth.php';
require_once 'conexao.php';
checkAuth();

$nome = $_POST['nome'] ?? '';
$especialidade = $_POST['especialidade'] ?? '';
$crm = $_POST['crm'] ?? '';

if (empty($nome) || empty($especialidade) || empty($crm)) {
    header('Location: ../restrito/cadastro.php?status=error&msg=PreenchaTodosCampos');
    exit;
}

try {
    $pdo = mysqlConnect();
    $sql = "INSERT INTO Medico (Nome, Especialidade, CRM) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $especialidade, $crm]);

    header('Location: ../restrito/cadastro.php?status=success_med');
    exit();

} catch (PDOException $e) {
    $errorCode = 'ErroDesconhecido';
    if ($e->errorInfo[1] == 1062) {
        $errorCode = 'CRMDuplicado';
    }
    header('Location: ../restrito/cadastro.php?status=error&msg=' . $errorCode);
    exit();
}
?>