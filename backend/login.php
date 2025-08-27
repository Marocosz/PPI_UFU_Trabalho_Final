<?php
// Define o cookie de sessão para ser válido por 1 dia
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'samesite' => 'Strict'
]);
session_start();

require_once 'conexao.php';

// Função auxiliar para construir URLs de forma segura
function build_url($path) {
    $host = $_SERVER['HTTP_HOST'];
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    // A partir do backend/, voltamos um nível (../) para chegar à raiz do projeto
    return "$protocol://$host$uri/../$path";
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header('Location: ' . build_url('login.html?error=1'));
    exit();
}

try {
    $pdo = mysqlConnect();
    $sql = "SELECT Codigo, Nome, Senhahash FROM Funcionario WHERE Email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $funcionario = $stmt->fetch();

    if ($funcionario && password_verify($senha, $funcionario['Senhahash'])) {
        // Sucesso! Cria a sessão
        $_SESSION['id_funcionario'] = $funcionario['Codigo'];
        $_SESSION['nome_funcionario'] = $funcionario['Nome'];
        
        // FUNCIONALIDADE ADICIONAL: Atualiza a data e hora do último login
        $sqlUpdate = "UPDATE Funcionario SET UltimoLogin = NOW() WHERE Codigo = ?";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([$funcionario['Codigo']]);
        
        // Redireciona para a área restrita usando a URL construída dinamicamente
        header('Location: ' . build_url('restrito/cadastro.php'));
        exit();
    } else {
        // Falha! Redireciona de volta com um erro
        header('Location: ' . build_url('login.html?error=1'));
        exit();
    }
} catch (Exception $e) {
    // Em caso de erro de banco, redireciona com um erro genérico
    header('Location: ' . build_url('login.html?error=1'));
    exit();
}
?>