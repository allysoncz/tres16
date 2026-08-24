<?php
session_start();
if(isset($_SESSION['usuario'])){
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Três16</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container-formulario">
    <form action="processa_login.php" method="POST">
        <h2>Login</h2>
        <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
        <a href="cadastro1.php">Cadastrar novo usuário</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
