<?php
/* ════════════════════════════════════════════════════════════
 * ARQUIVO    : includes/nav.php
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Aula       : 04 — PHP para Web: Formulários, GET e POST
 * Autor      : Caio Mario Zachesky Junior
 * Conceitos   : MMenu dinâmico, operador ternário, $caminho_raiz
 * ════════════════════════════════════════════════════════════
 *
 * Mesmo padrao do nav.php da Aula 03, com duas melhorias:
 *  1. Links montados via $ caminho_raiz ¬ funciona de qualquer pasta por conta do ../
 * 
 * Variáveis esperadas na página que inclui este aequivo:
 *  $pagina_atual - string: identifica qual item destacar no menu 
 *  $caminho_raiz - string: caminho relativo até a raiz do projeto
 *                 
 *
 */

if(!isset($pagina_atual))
     $pagina_atual = "";
if(!isset($caminho_raiz))
    $caminho_raiz = "../";


function menu_class($item, $atual){
  return ($item == $atual) ? 'class="ativo"' : '';
}



?>
<nav>
    
  <a href="<?php echo $caminho_raiz; ?>01_php-intro/index.php" 
  <?php echo menu_class("inicio", $pagina_atual);?>>
  🏯 Inicio 
</a>
  <a href="<?php echo $caminho_raiz; ?>01_php-intro/sobre.php" 
  <?php echo menu_class("sobre", $pagina_atual);?>>
  🤴 Sobre 
 </a>
  <a href="<?php echo $caminho_raiz; ?>01_php-intro/projetos.php" 
  <?php echo menu_class("projetos", $pagina_atual);?>>
  💻 Projetos
</a>
<a href="<?php echo $caminho_raiz; ?>02_formulario/contato.php"
  <?php echo menu_class("contato", $pagina_atual);?>>
  📬 Contado
</a>
<a href="<?php echo $caminho_raiz; ?>03_pdo/index.php"
 <?php echo menu_class("catalogo", $pagina_atual);?>>
 🗄️  Catálogo
</a>
<a href="<?php echo $caminho_raiz; ?>04_sessoes/login.php"
 <?php echo menu_class("Login", $pagina_atual);?>>
 📙 Login
</a>
<a href="<?php echo $caminho_raiz; ?>04_sessoes/painel.php"
 <?php echo menu_class("Painel", $pagina_atual);?>>
 💹Painel
</a>
<a href="<?php echo $caminho_raiz; ?>05_crud/index.php"
 <?php echo menu_class("Lista", $pagina_atual);?>>
 💼Lista de Projetos
</a>


</nav>