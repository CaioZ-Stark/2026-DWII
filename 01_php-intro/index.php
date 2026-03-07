<!-- 
 Disciplina : Desenvolvimento Wed II (DWII)
 Aula       : 03 - Arquitetura Web e Introdução ao PHP
 Autor      : Caio Mario Zachesky Junior
 Data       : 02/03/2026
 Repositório: https://github.com/CaioZ-Stark/2026-DWII
--> 
 <?php 
 $nome = "Caio Mario Zachesky Junior";
 $curso = "Técnico em Informática - IFPR";
 $atuacao = "Estudande do IFPR Campus Ponta Grossa";
 $pagina_atual = "inicio";
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portidólio - <?php echo $nome; ?></title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
   
    <div class="hero">
        <h1><?php echo $nome; ?></h1>
        <p><?php echo $atuacao; ?> | <?php echo $curso; ?></p>
    </div>
    <?php include 'includes/cabecalho.php'; ?>
    
    <div class="container">
        <h1>Olá jovens gafanhoto novamente, ainda me chamo <?php echo $nome; ?> Esse é o meu portfólio</h1>    
        <p>Esta página foi desenvolvida usado PHP em:</p>
            <strong><?php echo date("d/m/Y \à\s H:i:s") ?> </strong>
    </div>

    <?php include 'includes/rodape.php'; ?>
</body>
 </html>