<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

$produto = $_POST['produto'] ?? 'Produto Três16';

$valor = $_POST['valor'] ?? '89,90';

$imagem = $_POST['imagem'] ?? 'img/1.jpeg';

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Confirmar Compra - Três16

</title>

<link
rel="stylesheet"
href="css/style.css?v=2">

</head>

<body>

<?php include 'includes/header.php'; ?>

<div class="carrinho-container">

<h1>

Confirmar Compra

</h1>

<div class="item-carrinho">

<img
src="<?php echo htmlspecialchars($imagem); ?>"
alt="">

<div class="item-info">

<h2>

<?php
echo htmlspecialchars($produto);
?>

</h2>

<p>

Produto premium da coleção Três16.

</p>

<h3>

R$
<?php echo htmlspecialchars($valor); ?>

</h3>

<p>

<strong>Comprador:</strong>

<?php echo htmlspecialchars($_SESSION['usuario']); ?>

</p>

<form
action="salvar_venda_unico.php"
method="POST">

<input
type="hidden"
name="produto"
value="<?php echo htmlspecialchars($produto); ?>">

<input
type="hidden"
name="valor"
value="<?php echo htmlspecialchars($valor); ?>">

<label>

Forma de pagamento

</label>

<select name="pagamento">

<option value="PIX">

PIX

</option>

<option value="Cartão">

Cartão de Crédito

</option>

<option value="Boleto">

Boleto

</option>

</select>

<button type="submit">

Confirmar Compra

</button>

</form>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
