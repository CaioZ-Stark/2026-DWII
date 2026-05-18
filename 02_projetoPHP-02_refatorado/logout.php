<?php
/**
 * Disciplina   : Desenvolvimento Web II (DWII)
 * Aula         : 06 - Autenticação com sessões e controle de acesso
 * Arquivo      : na raiz;logout.php
 * Autor        : Caio Mario Zachesky Junior
 */

require_once __DIR__ .'/includes/auth.php';

$_SESSION = [];

if (ini_get('session.usu_cookies')){
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 4200, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}


session_destroy();
header('Location: index.php');
exit;
?>