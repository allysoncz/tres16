<?php

session_start();

$produto = $_POST['produto'] ?? '';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Avaliar produto - Três16</title>

<link rel="stylesheet" href="css/style.css?v=2">

</head>


<body>


<?php include 'includes/header.php'; ?>


<section class="avaliacao-container">


<div class="avaliacao-box">


<h2>
Avaliar produto
</h2>


<h3>
<?php echo htmlspecialchars($produto); ?>
</h3>


<p style="color:#aaa;">
Sua opinião ajuda outros clientes.
</p>



<form action="salvar_avaliacao.php" method="POST">


<input 
type="hidden" 
name="produto" 
value="<?php echo htmlspecialchars($produto); ?>">



<label>
Nota
</label>


<input 
type="number"
name="nota"
min="1"
max="5"
required>



<label>
Comentário
</label>


<textarea 
name="comentario"
placeholder="Conte sua experiência..."
required></textarea>



<button type="submit">
Enviar avaliação
</button>



</form>


</div>


</section>


<?php include 'includes/footer.php'; ?>


</body>

</html>