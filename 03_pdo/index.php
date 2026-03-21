<!--
Disciplina : Desenvolvimento Web II (DWII)
Aula       : 05 - php + MariaDB: persistência de dados via PDO
Autor      : Caio Mario Zachesky Junior
Data       : 16/03/2026
-->
<?php 

$titulo_pagina = "Catálogo de Tecnologias";
$pagina_atual = "catalogo";

require_once 'includes/conexao.php';

$stmt = $pdo->query('select * from tecnologias ORDER BY nome ASC');
$tecnologias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'includes/cab_pdo.php'; ?>
</head>
<body>
    <div class="container">
        <h1 class="titulo-secao">🗄️ Catálogo de Tecnologias</h1>
        <p style="color: #6b7280; margin-bottom:20px;">
            <?php echo count($tecnologias); ?> tecnologia (s) cadastrada (s)
        </p>

        <?php foreach ($tecnologias as $tec): ?>
            <div class="card">
                <div class="flex">
                    <h3><?php echo htmlspecialchars($tec['nome']); ?></h3>
                    <span class="categoria">
                        <?php echo htmlspecialchars($tec['categoria']); ?>
                    </span>
                </div>
                <p><?php echo htmlspecialchars($tec['descricao']);?></p>
                <a href="detalhe.php?id=<?php echo $tec['id']; ?>" class="detalhes">
                    Ver detalhes ¬
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php include 'includes/rod_pdo.php';?>
</body>
</html>