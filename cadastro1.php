<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Etapa 1</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container-formulario">
    <form action="salvar_usuario.php" method="POST">
        <h2>Cadastro - Etapa 1</h2>
        <p class="etapa-info">Dados Pessoais</p>
        <input type="text" name="nome" placeholder="Nome completo" required>
        <input type="text" name="cpf" placeholder="CPF (000.000.000-00)" required>
        <input type="text" name="endereco" placeholder="Endereço" required>
        <input type="text" name="bairro" placeholder="Bairro" required>
        <input type="text" name="cidade" placeholder="Cidade" required>
        <input type="text" name="estado" placeholder="Estado" maxlength="2" required>
        <input type="text" name="cep" placeholder="CEP" required>
        <button type="submit">Continuar</button>
        <a href="login.php">Já tenho conta</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
