<?php
/* ════════════════════════════════════════════════════════════
 * ARQUIVO    : 02_formulario/contato.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula       : 04 — PHP para Web: Formulários, GET e POST
 * Autor      : Caio Mario Zachesky Junior
 * Conceitos   : Formulário Html, method GET, $_GET, htmlspecialchars()
 * ════════════════════════════════════════════════════════════
 *
 * Página de contato ¬ primeira versão com GET.
 * cabecalho.php gera o head completo (incluindo o link para style.css) e o <body> até o main
 *
 *
 */

// Variaveis do Template
$nome = "Caio Mario Zachesky Junior";
$pagina_atual = "contato";
$caminho_raiz = "../";
$titulo_pagina = "Contato";
$caracter =  0; 
//Estado inicial
$nome_visitante = "";
$email ="";
$mensagem = "";
$rique = ""; //variavel para o assunto piata interna sobre Rique Junior
$erros = [];

//VAriaveis do usuario
if($_SERVER['REQUEST_METHOD'] === 'POST'){ // verifica se a mensagem foi enviada
    $email = trim($_POST['email'] ?? ''); // pegar o valor para a variavel email
    $nome_visitante = trim($_POST['nome_visitante'] ?? '');// pegar o valor para a variavel que contuta o nome do navegador
    $mensagem = trim($_POST['mensagem'] ?? '');//pegar o valor da mensagem que o navegador mandou
    $rique = trim($_POST['rique']??'');// pegar o valor do assunto da mensagem 
    

    if(empty($nome_visitante)){// verivica se o campo nome foi preenchido
        $erros[] = 'O campo Nome é obrigatório.';// mensagem de campo não preenchido
    }
    if(empty($mensagem)){// verivica se o campo mensagem foi preenchido
        $erros[] = 'O campo Mensagem é obrigatório.';// mensagem de campo não preenchido
    } elseif(mb_strlen($mensagem)<10){// verivica se tem menos de 10 caracteris
        $erros[] = 'A mensagem deve ter pelo menos 10 caracteres.';// mensagem de campo tem menos que 10
    } elseif(mb_strlen($mensagem)>500){//// verivica se tem mais de 500 caracteris
        $erros[]='A mensagem passou de 500 caracteres.';// mensagem de campo tem mais de 500
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){// verivica que o email e valido
        $erros[] = 'E-mail invalido.';//mensagem de email não validado
    }
    if(empty($rique)){// verivica se tem assunto
        $erros[] = 'Assunto não insirido';// mensagem que é necessario o assunto
    }
      
     if (empty($erros) ) {// se não tiver erro envia para o arquivo obrigado.php os seguides atribudos nome do navegador, assunto e a mensagem
        header('Location: obrigado.php?nome=' . urlencode($nome_visitante) . '&rique=' . urlencode($rique) . '&mensagem=' . urlencode($mensagem));
        exit;
    }
}
?>
<?php include '../includes/cabecalho.php'; ?>
<div class="container">
    <h1 class="titulo-secao">📬 Formulário de Contato</h1>

    <form class="form-container" action="contato.php" method="post">

        <label>
            Seu nome: 
        </label>
        <input type="text" name="nome_visitante" value="<?php echo htmlspecialchars($nome_visitante); ?>" >
        <br>
        <label>
            E-mail:
        </label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <br>
        <label>
            Assunto:
        </label>
        <select name="rique"> <option value=""></option> 
            <option value="Dúvida">Dúvida</option> 
            <option value="Trabalho">Proposta de trabalho</option>  
            <option value="Colaboração">Colaboração</option> 
            <option value="Outro">Outro</option> 
        </select>
        <br>
        <label>
            Sua mensagem:<small>(mín. 10, máx. 500 caracteres)</small>
        </label>
        <textarea id="mensagem" name="mensagem" rows="4"  ><?php echo htmlspecialchars($mensagem)?></textarea>
      
        <small><span id="numero">0</span> de 500 caracteres usados</small><br>
        <button type="submit">Enviar</button>


    </form>
  

    <?php if (!empty($erros)): ?>
        <div class="alerta-erro">
            <h3>❌ Corrija os erros:</h3>
        
        <?php foreach ($erros as $erro): ?>
            <p style="margin:4px 0;">X <?php echo htmlspecialchars($erro); ?></p>
        <?php endforeach; ?>
        </div>
<?php endif; ?>
</div>
<script>
            const textarea = document.getElementById("mensagem")// adiciona o elemento que estiver com id mensagem que nesse caso é o do campo das mensagem para a constande textarea
            const numero = document.getElementById("numero")// adiciona o elemento que esta com o id numero que no caso é span que mostra quantos caracteris já tem na mensagem
            textarea.addEventListener("input", function(){//quanto tiver um evento de input rode a função e isso faz que o texto no numero receba o numeros de caracteris da mensagem
            numero.textContent = textarea.value.length;
            });
</script>

<?php 


include '../includes/rodape.php'; ?>