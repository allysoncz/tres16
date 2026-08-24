<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<header>
    <div class="logo">
        <a href="index.php"><img src="img/logo.png" alt="Três16"></a>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <?php if(isset($_SESSION['usuario'])){ ?>
            <li><a href="pedidos.php">Minhas Compras</a></li>
            <?php } else { ?>
            <li><a href="login.php">Login</a></li>
            <?php } ?>
        </ul>
    </nav>
    <div class="topo-direita">
        <div class="buscar">
            <input type="text" id="pesquisa" placeholder="Buscar produto...">
            <button onclick="buscarProduto()">Buscar</button>
        </div>
        <?php if(isset($_SESSION['usuario'])){ ?>
        <strong class="usuario-logado"><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>
        <a href="carrinho.php" class="sacola"><img src="img/sacola.png" alt="Carrinho"></a>
        <a href="logout.php"><button>Sair</button></a>
        <?php } else { ?>
        <a href="login.php" class="sacola"><img src="img/sacola.png" alt="Carrinho"></a>
        <?php } ?>
    </div>
</header>