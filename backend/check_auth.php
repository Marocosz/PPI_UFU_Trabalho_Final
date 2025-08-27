<?php
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'samesite' => 'Strict'
]);
session_start();

function checkAuth()
{
    if (!isset($_SESSION['id_funcionario'])) {
        http_response_code(401); // Unauthorized
        header('Content-Type: application/json');
        echo json_encode(['sucesso' => false, 'mensagem' => 'Acesso não autorizado.']);
        exit();
    }
}
?>