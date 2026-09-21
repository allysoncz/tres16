<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";


$usuario = $_SESSION['usuario'] ?? "Anonimo";

$produto = addslashes($_POST['produto']);

$nota = intval($_POST['nota']);

$comentario = addslashes($_POST['comentario']);


$consulta = "

INSERT INTO avaliacoes
(usuario, produto, nota, comentario)

VALUES

(
'$usuario',
'$produto',
$nota,
'$comentario'
)

";


banco(
$server,
$user,
$password,
$db,
$consulta
);


header("Location: produtos.php");

exit;

?>