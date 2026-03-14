<!-- 
 Disciplina : Desenvolvimento Wed II (DWII)
 Aula       : 03 - Arquitetura Web e Introdução ao PHP
 Autor      : Caio Mario Zachesky Junior
 Data       : 07/03/2026
 Repositório: https://github.com/CaioZ-Stark/2026-DWII
--> 
<?php  
    $pagina_atual = "sobre"; 
    $nome = "Caio Mario Zachesky Junior";
    $caminho_raiz ="../";
    $titulo_pagina = "Portfólio - {$nome}";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include '../includes/cabecalho.php'; ?>
</head>
<body>
    


<main>
<h1 class="titulo-secao">Sobre mim</h1>

<p>
Meu nome é Caio e estou no 3° ano do Técnico em Informática do IFPR Campus Ponta Grossa.
Escolhi o curso técnico porque já gostava de tecnologia e também ouvi falar que o instituto tinha um bom curso.
Nesta página vou falar sobre meus gostos e meus planos para o futuro.
</p>

<h4>Gostos</h4>

<ol>
<li>Assistir
    <ul>
        <li>Vídeos no YouTube: Valorant, Fortnite e Rocket League.</li>
        <li>Matérias: vídeos de matemática e filosofia.</li>
        <li>Esportes: Futebol, Tênis de mesa, Futebol Americano e Fórmula 1.</li>
        <li>Séries: Cavaleiro dos Sete Reinos, Brooklyn 99 e E.R. Plantão Médico.</li>
    </ul>
</li>

<li>Praticar esportes
    <ul>
        <li>Futebol</li>
        <li>Futsal</li>
        <li>Tênis de mesa</li>
    </ul>
</li>
</ol>

<h4>Planos para o futuro</h4>

<p>No momento estou fazendo um projeto com alguns colegas para criar um mod de Minecraft.</p>

</main>
    <?php include '../includes/rodape.php' ?>
</body>
</html>