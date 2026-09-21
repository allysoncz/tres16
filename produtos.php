<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";

$consulta = "SELECT * FROM produtos ORDER BY Id";

if(isset($_POST['buscar']) && trim($_POST['buscar']) !== ''){
    $busca = addslashes(trim($_POST['buscar']));
    $consulta = "SELECT * FROM produtos WHERE nome LIKE '%$busca%' ORDER BY Id";
}

$resultado = banco($server, $user, $password, $db, $consulta);

$produtos = [];
while($linha = $resultado->fetch_assoc()){
    $produtos[] = $linha;
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

    <p class="sem-produto">
        Nenhum produto encontrado.
    </p>

<?php } ?>


<?php foreach($produtos as $produto){ ?>

    <div class="produto">

        <img
        src="<?php echo $produto['imagem']; ?>"
        alt="<?php echo htmlspecialchars($produto['nome']); ?>">


        <div class="produto-info">

            <h2>
                <?php echo htmlspecialchars($produto['nome']); ?>
            </h2>


            <h3>
                R$ <?php echo $produto['preco']; ?>
            </h3>



            <?php if(isset($_SESSION['usuario'])){ ?>

                <div class="botoes-produtos">

                <form action="carrinho.php" method="POST">

                    <input
                    type="hidden"
                    name="produto_id"
                    value="<?php echo $produto['Id']; ?>">

                    <button type="submit">
                        Adicionar ao Carrinho
                    </button>

                </form>



                <form action="confirmar.php" method="POST">

                    <input
                    type="hidden"
                    name="produto"
                    value="<?php echo htmlspecialchars($produto['nome']); ?>">


                    <input
                    type="hidden"
                    name="valor"
                    value="<?php echo $produto['preco']; ?>">


                    <input
                    type="hidden"
                    name="imagem"
                    value="<?php echo $produto['imagem']; ?>">


                    <button type="submit" class="botao-comprar">
                        Comprar
                    </button>

                </form>


                <form class="form-avaliar" action="avaliar.php" method="POST">

                    <input
                    type="hidden"
                    name="produto"
                    value="<?php echo htmlspecialchars($produto['nome']); ?>">

                    <button type="submit" class="botao-avaliar">
                        Avaliar produto
                    </button>

                </form>

                </div>

                <div class="avaliacoes-produto">

                <h3>Avaliações</h3>


                <?php

                require_once 'app/avaliacoes.php';

                $resultadoAvaliacoes = buscarAvaliacoes(
                    $produto['nome'],
                    $server,
                    $user,
                    $password,
                    $db
                );


                if($resultadoAvaliacoes->num_rows > 0){


                while($avaliacao = $resultadoAvaliacoes->fetch_assoc()){


                echo "

                <div class='avaliacao-item'>

                <strong>
                ".$avaliacao['usuario']."
                </strong>


                <p class='estrelas'>
                ".str_repeat("★",$avaliacao['nota'])."
                </p>


                <p>
                ".$avaliacao['comentario']."
                </p>


                </div>

                ";


                }


                }else{


                echo "<p style='color:#777;'>Nenhuma avaliação ainda.</p>";


                }


                ?>

                </div>


            <?php } else { ?>


                <a href="login.php">
                    <button>
                        Fazer Login para Comprar
                    </button>
                </a>


            <?php } ?>


        </div>

    </div>


<?php } ?>


</section>


<?php include 'includes/footer.php'; ?>


</body>

</html>
