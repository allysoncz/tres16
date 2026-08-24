<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Etapa 2</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container-formulario">
    <form action="salvar_login.php" method="POST">
        <h2>Cadastro - Etapa 2</h2>
        <p class="etapa-info">Criar Acesso</p>
        <input type="text" name="login" placeholder="Crie um login" required>
        <input type="password" name="senha" placeholder="Crie uma senha" required>
        <button type="submit">Finalizar Cadastro</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
