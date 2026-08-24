<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

$usuario = addslashes($_SESSION['usuario']);

if(
    $_SERVER['REQUEST_METHOD'] === 'POST'
    &&
    isset($_POST['produto'])
){

    $produto = addslashes($_POST['produto']);
    $preco = addslashes($_POST['preco']);
    $imagem = addslashes($_POST['imagem']);

    $consulta = "INSERT INTO carrinho (Id, usuario, produto, preco, imagem) VALUES (NULL, '$usuario', '$produto', '$preco', '$imagem')";

    banco($server, $user, $password, $db, $consulta);

    $_SESSION['notificacao'] = "Item adicionado ao carrinho!";

    header("Location: carrinho.php");
    exit;
}

$itens = [];

$consulta = "SELECT * FROM carrinho WHERE usuario = '$usuario' order by Id";

$resultado = banco($server, $user, $password, $db, $consulta);

while($linha = $resultado->fetch_assoc()){

    $itens[] = $linha;
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

Carrinho - Três16

</title>

<link
rel="stylesheet"
href="css/style.css?v=2">

</head>

<body>

<?php include 'includes/header.php'; ?>

<?php if(isset($_SESSION['notificacao'])){ ?>

<div class="notificacao">

<?php

echo $_SESSION['notificacao'];

unset($_SESSION['notificacao']);

?>

</div>

<?php } ?>

<div class="carrinho-container">

<h1>

Seu Carrinho

</h1>

<?php if(empty($itens)){ ?>

<div class="vazio">

<p>

Seu carrinho está vazio.

</p>

<a href="produtos.php">

<button>

Ver Produtos

</button>

</a>

</div>

<?php } else { ?>

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

<form
action="remover_carrinho.php"
method="POST">

<input
type="hidden"
name="id"
value="<?php echo $item['Id']; ?>">

<button
type="submit"
class="botao-remover">

Remover

</button>

</form>

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

<div class="centralizar-botao">

<a href="checkout.php">

<button>

Finalizar Compra

</button>

</a>

</div>

<?php } ?>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
