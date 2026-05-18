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
    $caminho_raiz = "./";


function menu_class($item, $atual): string{
  return ($item == $atual) ? 'class="ativo"' : '';
}

$logado = isset($_SESSION['usuario']);

?>
<nav>
    
  <a href="<?php echo $caminho_raiz; ?>index.php" 
  <?php echo menu_class("inicio", $pagina_atual);?>>
  🏯 Inicio 
</a>
  <a href="<?php echo $caminho_raiz; ?>sobre.php" 
  <?php echo menu_class("sobre", $pagina_atual);?>>
  🤴 Sobre 
 </a>
  <a href="<?php echo $caminho_raiz; ?>projetos.php" 
  <?php echo menu_class("projetos", $pagina_atual);?>>
  💻 Projetos
</a>
<a href="<?php echo $caminho_raiz; ?>contato.php"
  <?php echo menu_class("contato", $pagina_atual);?>>
  📬 Contado
</a>
<a href="<?php echo $caminho_raiz; ?>catalogo.php"
 <?php echo menu_class("catalogo", $pagina_atual);?>>
 🗄️  Catálogo
</a>

<?php if($logado): ?>
<a href="<?php echo $caminho_raiz; ?>painel.php"
 <?php echo menu_class("Painel", $pagina_atual);?>>
 💹Painel
</a>
<a href="<?php echo $caminho_raiz; ?>05_crud/index.php"
 <?php echo menu_class("Lista", $pagina_atual);?>>
 💼Lista de Projetos
</a>
<a href="<?php echo $caminho_raiz; ?>logout.php"
<?php echo menu_class("Sair", $pagina_atual);?>>
 👍Sair
</a>
<?php else: ?>
<a href="<?php echo $caminho_raiz; ?>login.php"<?php echo menu_class("Login", $pagina_atual); ?>>
  😎 Login
</a>
<?php endif; ?>
</nav>