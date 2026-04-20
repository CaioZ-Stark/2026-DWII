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
    $caminho_raiz ="./";
    $titulo_pagina = "Portfólio - {$nome}";
    $formacoes = [
        'curso' => 'Técnico em informatica',
        'institucao' => 'Institudo Federal do Paraná',
        'inicio' => '2024',
        'fim' => '2027',
        'ano_atual' => date('Y'),
    ];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    


<main>
    <h1 class="titulo-secao">Sobre mim</h1>

    <div class="card">
        <p>
            Meu nome é <span style="color: var(--vermelho); font-weight: bold;">
                <?php echo htmlspecialchars($nome); ?>
            </span>
            e sou estudante do 
            <b><?php echo htmlspecialchars($formacoes['curso']); ?></b> no 
            <b><?php echo htmlspecialchars($formacoes['institucao']); ?></b>.
        </p>

        <p>
            Iniciei em <b><?php echo htmlspecialchars($formacoes['inicio']); ?></b> e a previsão de término é 
            <b><?php echo htmlspecialchars($formacoes['fim']); ?></b>.
            Atualmente estou no 
            <b><?php echo htmlspecialchars($formacoes['ano_atual'] - $formacoes['inicio'] + 1); ?>º ano</b>.
        </p>
    </div>

    <h2 class="titulo-secao">Gostos</h2>

    <div class="card">
        <ol>
            <li><b>Assistir</b>
                <ul>
                    <li>🎮 YouTube: Valorant, Fortnite e Rocket League</li>

                    <li>📚 Estudos: vídeos de matemática e filosofia</li>

                    <li>🏎️ Esportes: Futebol, Tênis de mesa, Futebol Americano e 
                        <span style="color: var(--vermelho); font-weight: bold;">Fórmula 1</span> 
                    </li>

                    <li>📺 Séries:
                        <ul>
                            <li>
                                Cavaleiro dos Sete Reinos 
                            </li>
                            <li>
                                Brooklyn 99
                            </li>
                            <li>
                                E.R. Plantão Médico
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li><b>Praticar esportes</b>
                <ul>
                    <li>⚽ Futebol</li>
                    <li>🥅 Futsal</li>
                    <li>🏓 Tênis de mesa</li>
                </ul>
            </li>
        </ol>
    </div>

    <h2 class="titulo-secao">Planos para o futuro</h2>

    <div class="card">
        <p>No momento estou fazendo um projeto com alguns colegas para criar um mod de Minecraft.</p>
    </div>
</main>
    <?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>