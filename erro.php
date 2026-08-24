<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro - Três16</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="erro-container">
    <div class="erro-box">
        <h1>Erro no Login</h1>
        <p>Usuário ou senha inválidos.</p>
        <div class="centralizar-botao">
            <a href="login.php"><button>Tentar novamente</button></a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>