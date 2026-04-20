<?php
/**
 * ════════════════════════════════════════════════════════════
 * ARQUIVO    : index.php  (raiz do repositório 2026-DWII)
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula       : 04 — PHP para Web: Formulários, GET e POST
 * Autor      : Caio Mario Zachesky Junior
 * Conceitos  : Ponto de entrada, array associativo, foreach...
 * ════════════════════════════════════════════════════════════
 */


if(session_start() === PHP_SESSION_NONE){
    session_start();
}

$pagina_atual = 'inicio';
$caminho_raiz = './';
$titulo_pagina = 'Portfólio - Caio Mario Zachesky Junior';

$nome = 'Caio Mario Zachesky Junior';
$descricao = 'Estudante de Técnico em Informática no IFPR, apaixonado por desenvolvimento web e tecnologia. Este portfólio documento minha jornada de aprendizado ao logo da disciolina de Desenvolvimento WEB II.';
$email= 'caiozacheskymj@gmail.com';
 ?>

<!DOCTYPE html>

<html lang="pt-BR">
<head>
  <?php

include __DIR__ . '/includes/cabecalho.php';
?>

</head>
<body>

  <main>
    <section class="apresentacao">

  <!-- Foto de perfil -->
  <div class="foto-container">
    <img
      src="<?php echo $caminho_raiz; ?>00_apresentacao/imgs/foto-perfil.jpg"
      alt="Foto de <?php echo htmlspecialchars($nome); ?>"
      class="foto-perfil">
  </div>

  <!-- Bloco de texto + cards informativos -->
  <div class="texto-container">

    <h2>
      Olá, eu sou <?php echo htmlspecialchars($nome); ?>! 👋
    </h2>

    <?php
    ?>
    <p><?php echo htmlspecialchars($descricao); ?></p>

    <div class="info-cards">

      <div class="info-card">
        <span class="card-icon">🎓</span>
        <span class="card-texto">Técnico em Informática — IFPR CRPG</span>
      </div>

      <div class="info-card">
        <span class="card-icon">💻</span>
        <span class="card-texto">Desenvolvimento Web II — 2026</span>
      </div>

      <div class="info-card">
        <span class="card-icon">📧</span>
        <span class="card-texto">
          <?php echo htmlspecialchars($email); ?>
        </span>
      </div>

    </div><!-- /info-cards -->

  </div><!-- /texto-container -->

</section>
  </main>

  <?php include __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>