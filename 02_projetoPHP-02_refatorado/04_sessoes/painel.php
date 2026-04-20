<?php 
/*
Disciplina : Desenvolvimento Web II (DWII)
Aula       : 06 - Autenticação com sessões e controle de acesso
Arquivo    : 04_sessoes/painel.php
Autor      : Caio Mario Zachesky Junior 
*/

   
require_once __DIR__ .'/includes/auth.php';
requer_login();
$meg = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);


if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}
$_SESSION['visitas']++;

$titulo_pagina = 'Painel - Área Restrita';
$caminho_raiz = '../';
$pagina_atual = '';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ .'/../includes/cabecalho.php'  ?>
</head>
<body>
   
    <div class="container">
        <?php 
if($meg){
    echo '<div class="alerta-sucesso">'. htmlspecialchars($meg).'</div>';
}
 ?>
        <div class="alerta-sucesso">
           
           
            <p><strong>Login realizado em:</strong>
            <?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?>
            </p>
             <p><strong>Vezes que você visitou nesse momento:</strong>
            <?php echo htmlspecialchars($_SESSION['visitas'] ?? '-'); ?>
            </p>
        </div>
        <div class="card">
            <h3>📊 Painel de controle</h3>
            <p>Este conteúdo só é visível para usuários autenticados.
        
        </div>
     
            </p>
             <p style="margin-top: 24; text-align: center;">
            <a href="logout.php"
                style="background: red; color:aliceblue; padding: 10px 24px; border-radius: 6px; text-decoration: none; 
                font-weight: bold;">🚪 Sair</a>
            <a href="perfil.php"
                style="background: blue; color:aliceblue; padding: 10px 24px; border-radius: 6px; text-decoration: none; 
                font-weight: bold;">💌 Detalhes da conta</a>
            <a href="../05_crud/index.php" class="btn-primario">
                🗃 Gerenciar Projetos
            </a>
        </p>

    </div>

<?php require_once __DIR__ .'/../includes/rodape.php'; ?>
</body>
</html>