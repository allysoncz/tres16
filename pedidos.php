<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

$usuario = addslashes($_SESSION['usuario']);

$consulta = "SELECT * FROM vendas WHERE usuario = '$usuario' order by numero desc, Id";

$resultado = banco($server, $user, $password, $db, $consulta);

$compras = [];

while($linha = $resultado->fetch_assoc()){

    $compras[$linha['numero']][] = $linha;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Compras - Três16</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="carrinho-container">

<h1>Minhas Compras</h1>

<?php if(empty($compras)){ ?>

<div class="vazio">
    <p>Você ainda não fez nenhuma compra.</p>
    <a href="produtos.php"><button>Ver Produtos</button></a>
</div>

<?php } else { ?>

<?php foreach($compras as $numero => $itens){ ?>

<div class="item-carrinho">

<div class="item-info">

<h2>Venda <?php echo htmlspecialchars($numero); ?></h2>

<?php foreach($itens as $item){ ?>

<h3>
<?php echo htmlspecialchars($item['produto']); ?> - R$ <?php echo htmlspecialchars($item['valor']); ?>
</h3>

<?php } ?>

<p>
<strong>Pagamento:</strong>
<?php echo htmlspecialchars($itens[0]['pagamento']); ?>
</p>

<p>
<strong>Data:</strong>
<?php echo htmlspecialchars($itens[0]['data']); ?>
</p>

</div>

</div>

<?php } ?>

<?php } ?>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
