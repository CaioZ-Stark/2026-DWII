<?php
/**
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula : 13 - Refatoração Parte V: Painel admin
 * Arquivo : admin.php (raiz)
 * Descrição : Painel administrativo de projetos em pagina unica.
 * Lista, cadastra, edita e arquiva (soft delete).
 * Toda operação e registrada na tabela de logs. 
 */

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/conexao.php';
requer_login();

$pdo = conectar();
$erro = '';
$em_edicao = null;

/**
 * Registra uma operação na trilha de auditoria (tabela logs).
 * O usuario_login vem da sessao, NUNCA do formulario.
 */
function registrar_log(PDO $pdo, string $acao, int $registro_id, string $detalhes): void
{
    $stmt = $pdo->prepare("INSERT INTO logs (tabela_afetada, registro_id, acao, usuario_login, detalhes) VALUES ('projetos', :id, :acao, :usuario, :detalhes)");
    $stmt->execute([':id' => $registro_id, ':acao' => $acao, ':usuario' => usuario_atual(), ':detalhes' => $detalhes,]);

}
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $acao = $_POST['acao'] ?? '';

    if($acao === 'salvar'){
        $id = (int) ($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $tecnologias = trim($_POST['tecnologias'] ?? '');
        $link_github = trim($_POST['link_github'] ?? '');
        $ano = (int) ($_POST['ano'] ?? date('Y'));
        $status = trim($_POST['status'] ?? 'rascunho');
        if($nome === '' || $descricao === '' || $tecnologias === '' ){
            $erro = 'Preencha todos os campos obrigatorios.';
        }else{
            $link = $link_github !== '' ? $link_github : null;
            if($id > 0 ){
                $stmt = $pdo->prepare(
                    "UPDATE projetos SET nome = :nome, descricao = :descricao, tecnologias = :tecnologias, link_github = :link, ano= :ano, status = :status WHERE id = :id"
                );
                $stmt->execute([
                    ':nome' => $nome, ':descricao' => $descricao, ':tecnologias' => $tecnologias, ':link' => $link, ':ano' => $ano, ':status' => $status, ':id' => $id
                ]);
                
                registrar_log($pdo, 'UPDATE', $id, "Projeto editado por : $nome");

            } else{
                $stmt = $pdo->prepare(
                    "INSERT INTO projetos (nome, descricao, tecnologias, link_github, ano, status) VALUES (:nome, :descricao, :tecnologias, :link, :ano, :status)"
                );
                $stmt->execute([
                    ':nome' => $nome, ':descricao' => $descricao, ':tecnologias' => $tecnologias, ':link' => $link, ':ano' => $ano, ':status' => $status,
                ]);
                $id = (int) $pdo->lastInsertId();
                registrar_log($pdo, 'INSERT', $id, "Projeto criado: $nome");
            }
            header('Location: admin.php?ok=salvo');
            exit;
        }

        $em_edicao = [
            'id' => $id, 'nome' => $nome, 'descricao' => $descricao, 'tecnologias' => $tecnologias, 'link_github' => $link_github, 'ano' => $ano, 'status' => $status,
        ];

    }
    if ($acao === 'arquivar'){
        $id = (int) ($_POST['id'] ?? 0);
        if($id > 0){
            $stmt = $pdo->prepare(
                "UPDATE projetos SET status = 'arquivado' WHERE id = :id"
            );
            $stmt->execute([':id' => $id]);
            registrar_log($pdo, 'STATUS', $id, 'Status alterado para aquivado');

        }
        header('Location: admin.php?ok=arquivado');
        exit;
    }
 }
 if($em_edicao === null && isset($_GET['editar'])){
    $stmt = $pdo->prepare("SELECT * FROM projetos WHERE id = :id");
    $stmt->execute([':id' => (int) $_GET['editar']]);
    $em_edicao = $stmt->fetch() ?: null;
 }
 $filtros_validos = ['todos', 'rascunho', 'publicado', 'arquivado'];
 $filtro = $_GET['filtro'] ?? 'todos';
 if(!in_array($filtro, $filtros_validos, true)){
    $filtro = 'todos';
 }
 if($filtro === 'todos'){
    $projetos = $pdo->query("SELECT * FROM projetos ORDER BY criado_em DESC")->fetchAll();
 } else{
    $stmt = $pdo->prepare("SELECT * FROM projetos WHERE status = :s ORDER BY criado_em DESC");
    $stmt->execute([':s'=> $filtro]);
    $projetos = $stmt->fetchAll();
 }
 $pagina_atual ='painel';
 $titulo_pagina = 'Painel Admin - Portfolio';
 $caminho_raiz = './';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <?php require_once __DIR__ .'/includes/cabecalho.php'; ?>
</head>
<body>
    <main>
        <div class="container">
            <h1 class="titulo-secao">Painel Administrativo</h1>

            <?php if(isset($_GET['ok'])): ?>
                <div class="alerta-sucesso">
                    
                 <p style="margin: 0;">Operação realizada com sucesso.</p>
                    
                </div>
            <?php endif; ?>

            <?php if ($erro !== ''): ?>
                <div class="alerta-erro">
                    <p style="margin: 0;"><?php echo htmlspecialchars($erro);?></p>
                </div>
            <?php endif; ?>

            <h2 class="titulo-secao"><?php echo $em_edicao ? 'Editar projeto' : 'Novo projeto'; ?></h2>
            <form action="admin.php" method="post" class="formulario">
                <input type="hidden" name="acao" value="salvar">
                <input type="hidden" name="id" value="<?php echo (int) ($em_edicao['id'] ?? 0); ?>">

                <div class="campo">
                    <label class="label-campo">Nome *</label>
                    <input type="text" name="nome" class="input-texto" value="<?php echo htmlspecialchars($em_edicao['nome'] ?? ''); ?>">

                </div>
                <div class="campo">
                    <label class="label-campo">Descrição *</label>
                    <textarea name="descricao" class="input-texto" rows="4"><?php echo htmlspecialchars($em_edicao['descricao'] ?? '');?></textarea>

                </div>
                <div class="campo">
                    <label class="label-campo">Tecnologias *</label>
                    <input type="text" name="tecnologias" class="input-texto" value="<?php echo htmlspecialchars($em_edicao['tecnologias'] ?? ''); ?>">

                </div>
                 <div class="campo">
                    <label class="label-campo">Link GitHub (opcional)</label>
                    <input type="url" name="link_github" class="input-texto" value="<?php echo htmlspecialchars($em_edicao['link_github'] ?? ''); ?>">

                </div>
                <div class="campo">
                    <label class="label-campo">Ano *</label>
                    <input type="number" name="ano" class="input-texto" min="2000" max="2099" value="<?php echo (int) ($em_edicao['ano'] ?? date('Y')); ?>">

                </div>
                 <div class="campo">
                    <label class="label-campo">Status*</label>
                    <select name="status" class="input-texto" > <?php $st = $em_edicao['status'] ?? 'rascunho'; ?>
                    <?php foreach (['rascunho', 'publicado', 'arquivado'] as $op): ?>
                        <option value="<?php  echo $op; ?>" <?php echo $op === $st ? 'selected' : ''; ?>>
                            <?php echo ucfirst($op); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>                 
                </div>
                <div style="display: flex; gap: 12px; margin-top: 8px;">
                    <button type="submit" class="btn-primario">Salvar </button>
                    <?php if ($em_edicao): ?>
                        <a href="admin.php" class="btn-secundario">Cancelar edição</a>
                    <?php endif; ?>
                </div>
            </form>
            <h2 class="titulo-secao">Projetos cadastrados</h2>
            <form action="admin.php" method="get" style="margin-bottom: 16px;">
                <label class="label-campo">Filtrar por Status</label>
                <select name="filtro" class="input-texto" onchange="this.form.submit()">
                    <?php foreach ($filtros_validos as $op): ?>
                        <option value="<?php echo $op; ?>" <?php echo $op === $filtro ? 'selected' : ''; ?>>
                            <?php echo ucfirst($op) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
            </form>

            <?php if (empty($projetos)): ?>
                <p style="color: #6b7280;">Nenhum projeto neste filtro.</p>
            <?php else: ?>
                <table class="tabela" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left;">Nome</th>
                            <th>Ano</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projetos as $p): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($p['nome']); ?>
                                </td>
                                <td style="text-align: center;"><?php echo (int) $p['ano']; ?></td>
                                <?php if($p['status'] === 'publicado'): ?>
                                    <td style="text-align: center; color: green"><?php echo ucfirst($p['status']); ?></td>
                                <?php endif; ?>
                                <?php if($p['status'] === 'rascunho'): ?>
                                    <td style="text-align: center; color:#6b7280"><?php echo ucfirst($p['status']); ?></td>
                                <?php endif; ?>
                                <?php if($p['status'] === 'arquivado'): ?>
                                    <td style="text-align: center; color:red"><?php echo ucfirst($p['status']); ?></td>
                                <?php endif; ?>
                                    <td>
                                    <a href="admin.php?editar=<?php echo (int) $p['id']; ?>" class="btn-secundario">Editar</a>
                                    <?php if ($p['status'] !== 'arquivado'): ?>

                                        <form action="admin.php" method="post" style="display: inline;" onsubmit="return confirm('Arquivar este projeto?');">
                                            <input type="hidden" name="acao" value="arquivar">
                                            <input type="hidden" name="id" value="<?php echo (int) $p['id']; ?>">
                                            <button type="submit" class="btn-perigo">Arquivar</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
                <p style="text-align: right; color: #6b7280; font-size:14px;">
                    <?php echo count($projetos);  ?> projetos(s)
                </p>
                <?php endif; ?>    
        </div>
    </main>
    <?php require_once __DIR__ .'/includes/rodape.php'; ?>
</body>
</html>