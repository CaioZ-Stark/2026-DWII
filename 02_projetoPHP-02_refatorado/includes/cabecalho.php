<?php
/* ════════════════════════════════════════════════════════════
 * ARQUIVO    : includes/cabecalho.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula       : 04 — PHP para Web: Formulários, GET e POST
 * Autor      : Caio Mario Zachesky Junior
 * Conceitos   : Modularização, include, isse(), caminho dinâmico
 * ════════════════════════════════════════════════════════════
 *
 * Responsabilidade gera <meta>, <title></title>, link para o CSS
 * externo e inclui o nav.php. 
 * 
 * Variáveis esperadas na página que inclui este aequivo:
 *  $titulo_pagina - string (opcional): texto da aba do navegador
 *  $caminho_raiz - string: caminho relativo até a raiz do projeto
 *                  EX: '../' para páginas em 01_php-intro/ ou 02_formularios/ (um nível acima)
 *
 */
// isset () verifica se a variável foi definida antes de usá-la.
// Valor padrao atica caso a página esqueça de declarar $titulo_pagina.
if(!isset($titulo_pagina))
     $titulo_pagina = 'Portfólio DWII';
if(!isset($caminho_raiz))
    $caminho_raiz = './';
if(!isset($pagina_atual))
    $pagina_atual = '';
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo_pagina); ?></title>
    <link rel="stylesheet" href="<?php echo $caminho_raiz; ?>includes/style.css">

    <?php 
        include __DIR__.'/nav.php';
    ?>


