<?php
require_once __DIR__.'/includes/conexao.php';
$pdo = conectar();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if(!$id){
    header('Location: 404.php');
    exit;
}
$sql = 'Select * from projetos where id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id'=> $id]);
$pro = $stmt->fetch();// retorna uma linha do arry ou false se n aver

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ .'/../includes/cabecalho.php';  ?>
</head>
<body>
    <div class="container">
        <a href="index.php" class="voltar">Voltar ao catálogo</a>
        <div class="card" style="margin-top: 20px;">
            <div class="flex2">
                <h1 class="flex2"><?php echo htmlspecialchars($pro['nome']);?></h1>
                <span class="flex2">Tecnologias:<?php echo htmlspecialchars($pro['tecnologias']); ?></span>
                </div>
                <table>
                    <tr style="background: #f3f4f6;">
                        <td><b>ID<b></td>
                        <td><?php echo $pro['id']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Descrição</b></td>
                        <td><?php echo $pro['descricao']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Cadastrada em </b></td>
                        <td><?php echo date('d/m/Y \á\s H:i', strtotime($pro['criado_em'])) ?> no horário de Londres</td>
                    </tr>
                </table>
            
        </div>
    </div>





<?php  require_once __DIR__ .'/../includes/rodape.php'; ?>
</body>
</html>