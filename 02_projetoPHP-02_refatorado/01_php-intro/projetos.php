  <!-- 
 Disciplina : Desenvolvimento Wed II (DWII)
 Aula       : 03 - Arquitetura Web e Introdução ao PHP
 Autor      : Caio Mario Zachesky Junior
 Data       : 07/03/2026
 Repositório: https://github.com/CaioZ-Stark/2026-DWII
--> 
  <?php 
  $pagina_atual = "projetos";
  $nome = "Caio Mario Zachesky Junior";
  $caminho_raiz = "../";
  $titulo_pagina = "Portfólio - {$nome}";
  
  ?>
 <?php include '../includes/cabecalho.php'; ?>
 
 
<main>
 <h1 class="titulo-secao">Projetos</h1>
 <p>Essa página é para falar sobre os meus projeto</p>
 
 <h4>Site Portfðlio HTML/CSS/Banco de dados/ PHP</h4>
 <p>Ultima atividade de desenvolvimento Web I. Um site licado com banco de dados e CRUD completo</p>
<br>
 <h4>Campo minado</h4>
 <p>Esse foi o projeto final do primeiro ano proposto pelo Profe. Berssa</p>
 <a href="https://github.com/caio-zachesky/Codigos-do-Caio/blob/master/main%20(5).c" target="_blank"> campo minado </a>
<br>
 <h4>Projeto do futuro</h4>
 <p>Fazer um mod completo com poderes no estilo de evolução RPG</p>
 <br>
 <h4>Primeiro Projeto do Ano</h4>
<p>Primeiro projeto de 2026 só html & css <a href="../00_apresentacao/" target="_blank">Index.html</a></p>
  </main>
 <?php include '../includes/rodape.php'; ?>
