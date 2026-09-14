<!DOCTYPE html>
<html>
<head>
    <title>Avaliar Produto</title>
</head>

<body>

<h2>Avaliar produto</h2>

<form action="salvar_avaliacao.php" method="POST">

    Produto:
    <input type="text" name="produto" required>
    <br><br>

    Nota:
    <input type="number" 
           name="nota" 
           min="1" 
           max="5"
           required>

    <br><br>

    Comentário:
    <br>

    <textarea name="comentario" required></textarea>

    <br><br>

    <button type="submit">
        Enviar avaliação
    </button>

</form>

</body>
</html>