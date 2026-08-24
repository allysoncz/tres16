<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

$numero = time();
$produto = $_POST['produto'] ?? '';
$valor = $_POST['valor'] ?? '0,00';
$pagamento = $_POST['pagamento'] ?? 'PIX';

$usuario = addslashes($_SESSION['usuario']);
$cpf = addslashes($_SESSION['cpf'] ?? '');
$p = addslashes($produto);
$v = addslashes($valor);
$pag = addslashes($pagamento);
$data = date('d/m/Y H:i:s');

$consulta = "INSERT INTO vendas (Id, numero, usuario, cpf, produto, valor, pagamento, data) VALUES (NULL, '$numero', '$usuario', '$cpf', '$p', '$v', '$pag', '$data')";

banco($server, $user, $password, $db, $consulta);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Compra Finalizada - Três16

</title>

<link
rel="stylesheet"
href="css/style.css?v=2">

</head>

<body>

<?php include 'includes/header.php'; ?>

<div class="erro-container">

<div class="erro-box">

<h1>

✅ Compra realizada!

</h1>

<p>

Número da venda:

<strong>

<?php echo $numero; ?>

</strong>

</p>

<p>

Produto:

<strong>

<?php echo htmlspecialchars($produto); ?>

</strong>

</p>

<p>

Obrigado,

<strong>

<?php echo htmlspecialchars($_SESSION['usuario']); ?>

</strong>

!

</p>

<p>

Pagamento via:

<strong>

<?php echo htmlspecialchars($pagamento); ?>

</strong>

</p>

<div class="centralizar-botao">

<a href="index.php">

<button>

Voltar para a loja

</button>

</a>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
