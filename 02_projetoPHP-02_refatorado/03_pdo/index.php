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
// Capturar o filtro da URL (vazio se não existir)
$categoria = trim($_GET['categoria'] ?? '');
$termo = trim($_GET['buscar'] ?? '');
$descricao = trim($_GET['descricao'] ?? '');


$sql = 'SELECT * FROM tecnologias';
$condicoes = [];
$variaveis = [];

// filtro por categoria
if (!empty($categoria)) {
    $condicoes[] = 'categoria = :cat';
    $variaveis[':cat'] = $categoria;
}

// filtro por termo (nome OU descrição)
if (!empty($termo) && !empty($descricao)) {
    $condicoes[] = ' nome LIKE :ter OR descricao LIKE :de ';
    $variaveis[':ter'] = '%' . $termo . '%';
    $variaveis[':de'] = '%'. $descricao .'%';
}elseif(!empty($termo)){
    $condicoes[] = ' nome LIKE :ter ';
    $variaveis[':ter'] = '%' . $termo . '%';

}elseif(!empty($descricao)){
    $condicoes[] = ' descricao LIKE :de';
    $variaveis[':de'] = '%'. $descricao .'%';
}


// se tiver condições, adiciona WHERE
if (!empty($condicoes)) {
    $sql .= ' WHERE ' . implode(' AND ', $condicoes);
}

// ordenação (sempre pode ter)
$sql .= ' ORDER BY nome ASC';

// prepara e executa
$stmt = $pdo->prepare($sql);
$stmt->execute($variaveis);

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
        <form action="index.php" method="GET">
            <select name="categoria"> <option value=""></option> 
            <?php $sql2 = 'Select Distinct categoria from tecnologias';
             $stmt2 = $pdo->prepare($sql2);
             $stmt2->execute(); 
             $tecnologias2 = $stmt2->fetchAll();
             foreach ($tecnologias2 as $s):
            ?>
            <option value="<?php echo htmlspecialchars($s['categoria']); ?>"><?php echo htmlspecialchars($s['categoria']); ?></option> 
            <?php endforeach; ?>
        </select>
         <br>
            <input type="text" name="buscar" placeholder="Pesquisar por nome ">
            <input type="text" name="descricao" placeholder="Pesquisar por descrição">
            <button style="background-color: red;" type="submit">Filtrar</button>
        </form>
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