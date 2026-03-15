<?php 
/**
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula      : 04 - PHP para Web: Formulários, Get e Post
 * Autor     : Caio Mario Zachesky Junior
 * Conceitos : Ponto de entrada, array associativo, Foreach, date(), htmlspecialchars()
 * ========================================================================================
 * Hub de navegação - exibido quando o servidor sobe na raiz:
 * php -S localhost:8000
 * 
 * Por estar fora das subpastas, este arquivo não usa os includes compartilhados(cabecalho.php, nav.php, rodepe.php).
 * Cabeçalho, nav e rodapé são definidos inline aqui.
 */

// ------ VARIÁVEIS DE CONTEÚDO----------------------
$nome   = "Caio Mario Zachesky Junior";
$subtitulo = "Repositório 2026 ~ Desenvolvimento Web II";
//-------- CATÁLOGO DE AULAS-------------------------
$aulas = [
    [
        "numero" => "00",
        "nome" => "Apresentação Pessoal",
        "descricao" => "Página estática com HTML e CSS - foto de perfil e layout responsivo.",
        "link" => "00_apresentacao/index.html",
        "icone" => "👨‍💻",
        "cor" => "#6b6b80",
        "conceitos" => "HTML semântico, Css Flexbox, responsividade",
    ],
    [
        "numero" => "03",
        "nome" => "Portfólio Dinâmico com PHP",
        "descricao" => "Mine-site de portfólio com variáveis, inclues e menu dinâmico.",
        "link" => "01_php-intro/index.php",
        "icone" => "🐘",
        "cor" => "#423b9d",
        "conceitos" => "Variáveis, echo, include, foreach, operador ternário",
    ],
    [
        "numero" => "04",
        "nome" => "Formulário de Contato",
        "descricao" => "Formulário com validação no servidor, proteção XSS e padrão PRG.",
        "link" => "02_formulario/contato.php",
        "icone" => "📪",
        "cor" => "#453ba3",
        "conceitos" => '$_POST, validação, htmlspecialchars(), header() + exit',
    ],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subtitulo); ?></title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <div class="hero">
        <h1><?php echo htmlspecialchars($nome); ?></h1>
        <p><?php echo htmlspecialchars($subtitulo) ?></p>
</div>
    <main>
    
    
    <div class="container">
        <div class="box-info">
        <h3>
            ▶️ Como executar este repositório
        </h3>
        <p class="instrucao">
            Suba o servidor PHP na <strong>raiz</strong> para acessar todas as aulas:
        </p>
        <div>
            cd ~/workspaces/2026-DWII<br>php -S localhost:8000 
        </div>
        <p class="descricao">
            Esta página é o hub de navegação. Use os botões abaixo para acessar cada projeto.
        </p>
        
    </div>
    <h2 class="secao">🧾 Projetos por Aula </h2>
    
    <?php foreach ($aulas as $aula): ?>
        <div class="ajuste" style= "background-color:<?php echo $aula['cor']; ?>;" >
        <div class="card-aula" style="border-left-color: <?php echo $aula['cor']; ?>;"> </div>
        
        <div class="icone"><?php echo $aula['icone']; ?></div>
        
        <div class="conteudo">
            <span class="badge">Aula <?php echo htmlspecialchars($aula['numero']); ?>
        </span>
        
        <h3 style="color: <?php echo $aula['cor']; ?>;">
            <?php echo htmlspecialchars($aula['nome']); ?>
        </h3>
        <p> <?php echo htmlspecialchars($aula['descricao']);  ?>></p>
        <span class="conceitos">
            🎁<?php echo htmlspecialchars($aula['conceitos']); ?>
        </span><br>
        <a href="<?php echo htmlspecialchars($aula['link']); ?>"
            class="btn"
            style="background: <?php echo $aula['cor']; ?>; color: black">
            Abrir ->
        </a>

        </div>
    </div>
    <?php endforeach ?>

        <p class="tempo">
            🕐 Gerado em: <?php echo date("d/m/Y \à\s H:i:s"); ?>
        </p>
</main>
        <footer>
            <?php echo htmlspecialchars($nome); ?>
            &copy;<?php echo date("Y"); ?>
            | Desenvolvido com PHP | IFPR ¬ Ponta Grossa
            
        </footer>
    

</body>
</html>