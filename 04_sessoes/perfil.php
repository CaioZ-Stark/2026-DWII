<?php 
/*
Disciplina : Desenvolvimento Web II (DWII)
Aula       : 06 - Detalhes da conta
Arquivo    : 04_sessoes/perfil.php
Autor      : Caio Mario Zachesky Junior 
*/
 require_once __DIR__ .'/includes/auth.php';
requer_login();

$titulo_pagina = 'Painel - Área Restrita';
$caminho_raiz = '../';
$pagina_atual = '';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ .'/../includes/cabecalho.php'  ?>
</head>
<body>
     <div class="container">
        <div class="alerta-sucesso">
            <h3> ✔ Detalhes da conta!</h3>
            <p><strong>Usuário:</strong>
            <?php echo htmlspecialchars($_SESSION['usuario']); ?>
            </p>
            <p><strong>senha:</strong>
            <?php echo htmlspecialchars($_SESSION['senha'] ?? '-'); ?>
            </p>
             
        </div><br>
         <a href="painel.php"
                style="background: blue; color:aliceblue; padding: 10px 24px; border-radius: 6px; text-decoration: none; 
                font-weight: bold;">💌 Voltar para Painel</a>
</body>
</html>