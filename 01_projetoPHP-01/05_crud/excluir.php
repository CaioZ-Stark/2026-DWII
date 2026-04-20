<?php 
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula : 08 - CRUD Completo: Delete
 * Arquivo : 05_crud/excluir.php
 * Autor   : Caio Mario Zachesky Junior
 * Data    : 12/04/2026
 * Descrição : Implementa o D do CRUD (Delete).
 *              Este arquivo tem três responsabilidades:
 *              1. Validar o ID recebio via Get
 *              2. Exibir tela de confirmação (GET)
 *              3. Processar o delete após confirmação (POST)
 * 
 *              REGRA: DELETE nunca é executado via GET.
 *              Somente um POST intencional dispara a remoção.
 */

require_once __DIR__ .'/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ .'/includes/conexao.php';

$id = (int) ($_GET['id'] ?? 0);

if($id <= 0){
    header('Location: index.php?erro=id_invalido');
    exit;
}


$pdo = conectar();
$stmt = $pdo->prepare('SELECT nome FROM projetos WHERE id = :id');
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();

if(!$projeto){
     header('Location: index.php?erro=nao_encontra');
    exit;
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $stmt = $pdo->prepare('DELETE FROM projetos WHERE id = :id');
    $stmt->execute([':id' => $id]);

    header('Location: index.php?excluido=ok');
    exit;
}

$titulo_pagina = 'Excluir Projeto - Portfólio';
$caminho_raiz = '../';
$pagina_atual = '';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php';?>
</head>
<body>
    <div class="container">

        <h1 class="titulo-secao">🗑 Confirmar Exclusão</h1>

        <div class="card" style="max-width: 480px;">

            <p style="font-size: 16px; margin: 0 0 8px;">
                Você está prestes a excluir o projeto:
            </p>

            <p style="font-size: 18px; font-weight: bold; color: #9c0202; margin: 0 0 16px;">
                <?php echo htmlspecialchars($projeto['nome']); ?>
            </p>

            <p style="font-size: 14px; color: #000850; margin: 0 0 20px;">
                ⚠ Esta ação <strong>não pode ser desfeita</strong>.
            </p>

            <form action="excluir.php?id=<?php echo $id; ?>" method="post">

                <div style="display: flex; gap: 12px;">

                    <button type="submit" class="btn-perigo"> 🗑 Sim, excluir</button>
                    <a href="index.php" class="bnt-secundario">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <?php require_once __DIR__ .'/../includes/rodape.php'; ?>
</body>
</html>