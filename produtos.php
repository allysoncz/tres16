<?php
session_start();
require_once 'includes/produtos_lista.php';

if(isset($_GET['buscar']) && trim($_GET['buscar']) !== ''){
    $produtos = array_filter($produtos, function($p){
        return str_contains(strtolower($p['nome']), strtolower(trim($_GET['buscar'])));
    });
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Três16</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<?php include 'includes/header.php'; ?>

<section class="produtos">
<?php if(empty($produtos)){ ?>
    <p class="sem-produto">Nenhum produto encontrado.</p>
<?php } ?>
<?php foreach($produtos as $produto){ ?>
    <div class="produto">
        <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
        <div class="produto-info">
            <h2><?php echo htmlspecialchars($produto['nome']); ?></h2>
            <p>Coleção premium Três16.</p>
            <h3>R$ <?php echo $produto['preco']; ?></h3>
            <?php if(isset($_SESSION['usuario'])){ ?>
            <form action="carrinho.php" method="POST">
                <input type="hidden" name="produto" value="<?php echo htmlspecialchars($produto['nome']); ?>">
                <input type="hidden" name="preco" value="<?php echo $produto['preco']; ?>">
                <input type="hidden" name="imagem" value="<?php echo $produto['imagem']; ?>">
                <button type="submit">Adicionar ao Carrinho</button>
            </form>
            <form action="confirmar.php" method="POST">
                <input type="hidden" name="produto" value="<?php echo htmlspecialchars($produto['nome']); ?>">
                <input type="hidden" name="valor" value="<?php echo $produto['preco']; ?>">
                <input type="hidden" name="imagem" value="<?php echo $produto['imagem']; ?>">
                <button type="submit" class="botao-comprar">Comprar</button>
            </form>
            <?php } else { ?>
            <a href="login.php"><button>Fazer Login para Comprar</button></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</section>

<?php include 'includes/footer.php'; ?>
</body>
</html>
