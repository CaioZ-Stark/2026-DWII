<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Arquivo   : includes/auth
 * Descrição : Helpers de autenticação - verifica login e protege páginas.
 */
date_default_timezone_set('America/Sao_Paulo');
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

function  usuario_logado(): bool {
    return isset($_SESSION['usuario']) && $_SESSION['usuario'] !== '';
}

function usuario_atual(): ?string{
    return $_SESSION['usuario'] ?? null;
}

function requer_login(): void {
    if(!usuario_logado()){
        header('Location: login.php');
        exit;
    }
}

?>