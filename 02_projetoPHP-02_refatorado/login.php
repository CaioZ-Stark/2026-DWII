<?php 
/*
Disciplina : Desenvolvimento Web II (DWII)
Aula       : 06 - Autenticação com sessões e controle de acesso
Arquivo    : 04_sessoes/login.php
Autor      : Caio Mario Zachesky Junior 
Data       : 23/03/2026
*/

require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ .'/includes/auth.php';

// Se já estiver logado, ir direto ao painel
if(usuario_logado()){
    header('Location: painel.php');
    exit;
}
if(!isset($_SESSION['tentativas'])){
    $_SESSION['tentativas'] = 0;
}
if(!isset($_SESSION['bloqueado_ate'])){
    $_SESSION['bloqueado_ate'] = 0;
}




$erro = '';
$login = '';
if(time() < $_SESSION['bloqueado_ate']){
        $erro = 'Você excedeu o limide de erros espere 60 segundos';
    }

if($_SERVER['REQUEST_METHOD'] === 'POST' && time() > $_SESSION['bloqueado_ate']){
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    if($login === '' || $senha === ''){
        $erro= 'Infome usuário e senha.';
    }else{
        $pdo = conectar();
        $stmt = $pdo->prepare(
            "SELECT id, login, senha FROM usuarios WHERE login = :login AND status = 'ativo' LIMIT 1");
            $stmt->execute([':login' => $login]);
            $usuario = $stmt->fetch();
    
    if($usuario  && password_verify($senha, $usuario['senha'])){
        //Credenciais corretas - novo ID de sessão após login (segurança)
        session_regenerate_id(true);
        $_SESSION['usuario'] = $usuario['login'];
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['bloqueado_ate'] = 0;
        $_SESSION['tentativas']=0;
        $_SESSION['logado_em'] = date('d/m/Y H:i:s');
        $log = $pdo->prepare("INSERT INTO logs (tabela_afetada, registro_id, acao, usuario_login, detalhes) VALUES ('usuarios', :id, 'LOGIN', :login, 'Login bem-sucedido')");
        $log ->execute([
            ':id' => $usuario['id'],
            ':login'=> $usuario['login'],
        ]);
        header('Location: painel.php');
        exit;    
        }else{
        $log = $pdo->prepare(
            "INSERT INTO logs (tabela_afetada, registro_id, acao, usuario_login, detalhes) VALUES ('usuarios', 0 , 'LOGIN_FAIL', :login,'Credenciais inválidas') "
        );
        $log->execute([':login' => $login]);
        $erro = 'Usuario ou senha incorretos.';
        $_SESSION['tentativas']++;
        if($_SESSION['tentativas'] >= 3){
            $_SESSION['bloqueado_ate'] = time()+60;
            
        }
    } 

    }
    
}
$titulo_pagina = 'Login - Área Restrita';
$caminha_raiz = './';
$pagina_atual = '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container" style="max-width: 420;">
        <div class="form-container">
        <h1 class="titulo-secao" style="text-align: center; font-size: 22px;">
            🔐 Área Restrita
        </h1>
        
        <?php if($erro): ?>
            <div class="alerta-erro">
                <p style="margin: 0; font-size: 14px;">
                    ❌ <?php echo htmlspecialchars($erro); ?>
                </p>
            </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label>Usuário:</label>
            <input
             type="text"
             name="login" 
             autocomplete="username" required >
            <label>Senha:</label>
            <input 
            type="password" 
            name="senha" 
            autocomplete="current-password" required><br>
            <button type="submit">Entrar</button>
        </form>
        <p style="text-align: center; margin-top: 20px; font-size: 13px; color: #6b7280;">
            <a href="../index.php" style="color: #ff0202;"> <= Voltar ao início</a>
        </p>
    </div>
</div>
<?php require_once __DIR__ .'/includes/rodape.php' ?>
</body>
</html>
