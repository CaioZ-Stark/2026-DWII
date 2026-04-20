<?php
/* ════════════════════════════════════════════════════════════
 * ARQUIVO    : 02_formulario/obrigado.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula       : 04 — PHP para Web: Formulários, GET e POST
 * Autor      : Caio Mario Zachesky Junior
 * Conceitos   : heade() + exit (PRG), $_GET para parâmetros de confirmação, htmlspecialchars()
 * ════════════════════════════════════════════════════════════
 *
 */
$nome = "Caio Mario Zachesky Junior";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Contato";

$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'visitante');
$rique = htmlspecialchars($_GET['rique'] ?? 'não achado');
$carac = htmlspecialchars($_GET['mensagem'] ?? 'caracteres não calculador');
$vcarac = mb_strlen($carac, 'UTF-8');
?>



<?php include '../includes/cabecalho.php';?>


<div class="containerconfirmacao">
    <p class="confirmacao-icone">✅</p>
    <h1 class="confirmacao-titulo">
        Obrigado, <?php echo $nome_visitante ?>
    </h1>
    <p class="confirmacao-texto">Sua mensagem foi recebida com assunto <b><?php echo $rique ?></b> e numeno de caracteris usados <b><?php echo $vcarac ?></b>. Entrarei em contato em breve.</p>
    <a href="contato.php" class="btn">¬ Enviar outra mensagem.</a>
</div>
<?php include '../includes/rodape.php';?>