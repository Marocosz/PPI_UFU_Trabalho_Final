<?php
// Garante que a sessão seja iniciada com os parâmetros corretos
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'samesite' => 'Strict'
]);
session_start();

$_SESSION = array();

session_destroy();


header('Location: ../login.html');
exit(); 
?>