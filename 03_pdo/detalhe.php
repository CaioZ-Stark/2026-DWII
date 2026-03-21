<?php
$caminho_raiz = '../';

require_once 'includes/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if(!$id){
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('select * from tecnologias where id = :id');
$stmt->execute(['id'=> $id]);
$tec = $stmt->fetch();// retorna uma linha do arry ou false se n aver

if (!$tec){
    header('Location: index.php');
    exit;
}

$titulo_pagina = htmlspecialchars($tec['nome']) . "- Catálogo";
$pagina_atual = "catalogo";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'includes/cab_pdo.php'; ?>
</head>
<body>
    <div class="container">
        <a href="index.php" class="voltar">Voltar ao catálogo</a>
        <div class="card" style="margin-top: 20px;">
            <div class="flex2">
                <h1 class="flex2"><?php echo htmlspecialchars($tec['nome']);?></h1>
                <span class="flex2"><?php echo htmlspecialchars($tec['categoria']); ?></span>
                <p  class="flex2"> <?php echo htmlspecialchars($tec['descricao']); ?></p>
                </div>
                <table>
                    <tr style="background: #f3f4f6;">
                        <td><b>ID<b></td>
                        <td><?php echo $tec['id']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Ano de criação</b></td>
                        <td><?php echo $tec['ano_criacao']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Cadastrada em </b></td>
                        <td><?php echo date('d/m/Y \á\s H:i', strtotime($tec['criado_em'])) ?></td>
                    </tr>
                </table>
            
        </div>
    </div>
    <?php include 'includes/rod_pdo.php'; ?>
</body>
</html>