<?php 
/*
---------------------------------------------------------------------------
Arquivo : 03_pdo/includes/cab_pdo.php
Disciplina : Desenvolvimento Web II (2026-DWII)
Aula : 05 -- PHP + MariaDB: persistência de dados via PDO
---------------------------------------------------------------------------

Proxy local que reutiliza o cabecalho.php global da raiz / includes/
__DIR__ = 03_pdo/includes/  - ../../includes/ = raiz/includes/
*/ 


//Garantir valores padões caso a página não defina essa variáveis
if(!isset($titulo_pagina)) $titulo_pagina = "Catálogo de Tecnologia";
if(!isset($pagina_atual)) $pagina_atual = "";

$caminha_raiz ='../';


include __DIR__. '/../../includes/cabecalho.php';
?>