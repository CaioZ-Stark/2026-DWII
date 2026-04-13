<?php 
/**
 * Disciplina   : Desenvolvimento Web II (DWII)
 * Aula         : 07 - CRUD: Create e Read
 * Arquivo      : 05_crud/index.php
 * Autor        : Caio Mario Zachesky Junior
 * Data         : 04/04/2026
 * Descrição    : Lista todos os projetos cadastrados no banco (Read)
 */

// --- Proteção: apenas usuários autenticados ---
require_once __DIR__ .'/../04_sessoes/includes/auth.php';
requer_login();

// --- Dependências ---
require_once __DIR__.'/includes/conexao.php';

// --- Busca todos os projetos ordenados pelo mais recente ---
$pdo = conectar();
$sql = 'Select * from projetos';


// ---Mensaegem de sucesso após cadastro ---


$conticao = [] ;
$variavel = [];
$termo = trim($_GET['buscar'] ?? '');
$tecnologias = trim($_GET['tecnologias'] ?? '');

if(!empty($tecnologias)){
    $conticao[] = 'tecnologias like :tec';
    $variavel[':tec'] = '%' . $tecnologias. '%';
}
if(!empty($termo)){
    $conticao[] = ' nome like :ter';
    $variavel[':ter'] = '%' . $termo . '%';
    
}
if (!empty($conticao)) {
    $sql .= ' WHERE ' . implode(' AND ', $conticao);
    $sql .= ' Order By criado_em DESC';
}



$stmt = $pdo->prepare($sql);
$stmt->execute($variavel);
$projetos = $stmt->fetchAll();

$cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';
$editadoOk = isset($_GET['editado']) && $_GET['editado'] === 'ok';
$excluidoOk = isset($_GET['excluido']) && $_GET['excluido'] === 'ok';

$erroMsg    = isset($_GET['erro']) ? $_GET['erro'] : '';

$titulo_pagina = 'Meus Projetos - Portfólio';
$caminho_raiz = '../';
$pagina_atual = '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ .'/../includes/cabecalho.php';  ?>
</head>
<body>
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap:wrap; gap:12px; margin-bottom:20px;">
        <h1 class="titulo-secao" style="margin: 0;">💼 Meus Projetos</h1>
        <a href="cadastrar.php" class="btn-primerio">➕ Novo Projeto</a>
    </div>
    <form action="index.php" method="GET">
         <select name="tecnologias"> <option value=""></option> 
            <?php $sql2 = 'Select Distinct tecnologias from projetos';
             $stmt2 = $pdo->prepare($sql2);
             $stmt2->execute(); 
             $projetos2 = $stmt2->fetchAll();
             foreach ($projetos2 as $s):
            ?>
            <option value="<?php echo htmlspecialchars($s['tecnologias']); ?>"><?php echo htmlspecialchars($s['tecnologias']); ?></option> 
            <?php endforeach; ?>
         </select>
        <input type="text" name="buscar" placeholder="Pesquisar por nome ">
        <button style="background-color: red;" type="submit">Filtrar</button>
    </form>

    <?php if ($cadastroOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">
                ✔ Projeto cadastrado com sucesso!
            </p>
        </div>
    <?php  endif; ?>
     <?php if ($editadoOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">
                ✔ Projeto atualizado com sucesso!
            </p>
        </div>
    <?php  endif; ?>
     <?php if ($excluidoOk): ?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">
                ✔ Projeto apagado com sucesso!
            </p>
        </div>
    <?php  endif; ?>

     <?php if ($erroMsg === 'nao_encontra'): ?>
        <div class="alerta-erro">
            <p style="margin: 0;">
               Projeto não encontrado. Ele pode já ter sido removido.
            </p>
        </div>
        <?php elseif($erroMsg === 'id_invalido'): ?>
        <div class="alerta-erro">
            <p style="margin: 0;">
              Requisição inválida.
            </p>
        </div>
    <?php  endif; ?>

    <?php if (empty($projetos)): ?>
        <!-- Estado vazio: nenhum projeto ainda -->
         <div class="card" style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <p style="font-size: 40px; margin: 0 0 12px;">📭</p>
            <p style="font-size: 16px; margin: 0 0 16px;">Nenhum projeto cadastrado ainda.</p>
            <a href="cadastrar.php" class="btn-primario">➕ Cadastrar o primeiro projeto </a>
         </div>
    <?php else: ?>
        <!-- Grade de projetos -->
         <div style="display: grid; grid-template-columns: repeat (auto-fill, minmax(280px, 1fr)); gap: 20px;" >
            <?php foreach($projetos as $projeto): ?>
                <div class="card">
                    <h3 style="margin: 0 0 8px; color:aqua; font-size:18px;">
                        <?php echo htmlspecialchars($projeto['nome']); ?>
                    </h3>

                    <p style="margin: 0 0 10px; font-size: 14px; color: #d80000a2; line-height: 1.6;">
                        <?php echo htmlspecialchars($projeto['descricao']); ?>
                    </p>

                    <p style="margin: 0 0 6px; font-size: 13px; color: #d80000d0;">
                        🛠<?php echo htmlspecialchars($projeto['tecnologias']); ?>
                    </p>

                    <p style="margin: 0 0 12px; font-size: 13px; color: #d80000e3;">
                        📆<?php echo htmlspecialchars($projeto['ano']); ?>
                    </p>

                    <?php if ($projeto['link_github']): ?>
                        <a href="<?php echo htmlspecialchars($projeto['link_github']); ?> " 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="btn-secundario"
                            >🔗 Ver no GitHub
                        </a>
                    <?php endif; ?>
                    <div style="margin-top:12px ; display:flex; gap:8px; flex-wrap:wrap;">
                    <a href="detalhe.php?id=<?php echo $projeto['id']; ?>" class="detalhes">
                    Ver detalhes ¬
                    </a><br>
                    <a href="editar.php?id=<?php echo (int) $projeto['id']; ?>" class="detalhes">
                    ✏️Editar ¬
                    </a><br>
                    <a href="excluir.php?id=<?php echo (int) $projeto['id']; ?>" class="detalhes">
                    🗑️Excluir ¬
                    </a>
                    </div>
                </div>
            <?php endforeach; ?>
         </div>
        <p style="margin-top: 16px; font-size:14px; color:#d80000; text-align: right;">
            <?php echo count($projetos); ?> projeto(s) cadastrado(s)
        </p>
    <?php  endif; ?>
</div>

<?php  require_once __DIR__ .'/../includes/rodape.php'; ?>
</body>
</html>