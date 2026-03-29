<?php 
/*
Disciplina : Desenvolvimento Web II (DWII)
Aula       : 06 - Autenticação com sessões e controle de acesso
Arquivo    : 04_sessoes/includes/auth.php
Autor      : Caio Mario Zachesky Junior 
*/

/*
requer_login()
Verifica se há sessões ativa.
Se n houver, redireciona para o login e encerra.
Chamar no topo de qualquer página protegida.
*/
function requer_login(): void
{
    if (session_status() === PHP_SESSION_NONE){
        session_start();// iniciar se ainda não foi iniciada
    }

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
        exit;
    }
}

function usuario_logado(): string
{
    return $_SESSION['usuario'] ?? '';
}
?>