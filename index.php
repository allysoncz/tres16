<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Três16</title>

<link rel="stylesheet" href="css/style.css?v=2">

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<?php include 'includes/header.php'; ?>

<section class="destaque">

    <div class="destaque-imagem">

        <img src="img/camisainicio3.jpg" alt="">

    </div>

    <div class="destaque-texto">

        <h1>
            Qualidade acima do comum.
        </h1>

        <p>
            Tecidos premium, durabilidade e conforto para quem carrega identidade.
        </p>

    </div>

</section>

<section class="destaque invertido">

    <div class="destaque-imagem">

        <img src="img/2.jpeg" alt="">

    </div>

    <div class="destaque-texto">

        <h1>
            Mais que roupa.
        </h1>

        <p>
            A Três16 transforma fé, estilo e propósito em expressão visual.
        </p>

    </div>

</section>

<section class="chamada-final">

    <h1>
        Conheça toda a coleção
    </h1>

    <a href="produtos.php">

        <button>
            Ver produtos
        </button>

    </a>

</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
