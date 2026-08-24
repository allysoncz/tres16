<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

$usuario = addslashes($_SESSION['usuario']);

$itens = [];

$consulta = "SELECT * FROM carrinho WHERE usuario = '$usuario' order by Id";

$resultado = banco($server, $user, $password, $db, $consulta);

while($linha = $resultado->fetch_assoc()){

    $itens[] = $linha;
}

if(empty($itens)){
    header("Location: carrinho.php");
    exit;
}

$total = 0;

foreach($itens as $item){

    $total += floatval(
        str_replace(',', '.', $item['preco'])
    );
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Checkout - Três16

</title>

<link
rel="stylesheet"
href="css/style.css?v=2">

</head>

<body>

<?php include 'includes/header.php'; ?>

<div class="carrinho-container">

<h1>

Finalizar Compra

</h1>

<?php foreach($itens as $item){ ?>

<div class="item-carrinho">

<img
src="<?php echo $item['imagem']; ?>"
alt="">

<div class="item-info">

<h2>

<?php
echo htmlspecialchars(
$item['produto']
);
?>

</h2>

<h3>

R$
<?php echo $item['preco']; ?>

</h3>

</div>

</div>

<?php } ?>

<div class="total">

Total:
R$

<?php

echo number_format(
$total,
2,
',',
'.'
);

?>

</div>

<form
action="salvar_venda.php"
method="POST">

<label>

Forma de pagamento

</label>

<select name="pagamento">

<option value="PIX">

PIX

</option>

<option value="Cartão">

Cartão

</option>

<option value="Boleto">

Boleto

</option>

</select>

<input
type="hidden"
name="total"
value="<?php echo number_format($total,2,',','.'); ?>">

<button type="submit">

Confirmar Compra

</button>

</form>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
