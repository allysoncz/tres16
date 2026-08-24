<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

$usuario = addslashes($_SESSION['usuario']);
$cpf = addslashes($_SESSION['cpf'] ?? '');
$numero = time();
$pagamento = addslashes($_POST['pagamento'] ?? 'PIX');
$data = date('d/m/Y H:i:s');

// itens do carrinho
$itens = [];

$consulta = "SELECT * FROM carrinho WHERE usuario = '$usuario' order by Id";

$resultado = banco($server, $user, $password, $db, $consulta);

while($linha = $resultado->fetch_assoc()){

    $itens[] = $linha;
}

foreach($itens as $item){

    $produto = addslashes($item['produto']);
    $valor = addslashes($item['preco']);

    $consulta = "INSERT INTO vendas (Id, numero, usuario, cpf, produto, valor, pagamento, data) VALUES (NULL, '$numero', '$usuario', '$cpf', '$produto', '$valor', '$pagamento', '$data')";

    banco($server, $user, $password, $db, $consulta);
}

// esvazia o carrinho
$consulta = "DELETE FROM carrinho WHERE usuario = '$usuario'";

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

Obrigado,

<strong>

<?php echo htmlspecialchars($_SESSION['usuario']); ?>

</strong>

!

</p>

<p>

Pagamento via:

<strong>

<?php echo htmlspecialchars($_POST['pagamento'] ?? 'PIX'); ?>

</strong>

</p>

<p>

Total:

<strong>

R$ <?php echo $_POST['total'] ?? '0,00'; ?>

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
