<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

$_POST['login'] = trim($_POST['login'] ?? '');

$usuario = addslashes($_POST['login']);
$senha = password_hash($_POST['senha'] ?? '', PASSWORD_DEFAULT);
$cpf = addslashes($_SESSION['cpf'] ?? 'sem_cpf');

// não deixa criar dois logins com o mesmo nome
$consulta = "SELECT * FROM acesso WHERE usuario = '$usuario'";
$resultado = banco($server, $user, $password, $db, $consulta);
$linha = $resultado->fetch_assoc();

if($linha){
    $consulta = "UPDATE acesso SET senha = '$senha', cpf = '$cpf' WHERE usuario = '$usuario'";
    banco($server, $user, $password, $db, $consulta);
}else{
    $consulta = "INSERT INTO acesso (Id, usuario, senha, cpf) VALUES (NULL, '$usuario', '$senha', '$cpf')";
    banco($server, $user, $password, $db, $consulta);
}

unset($_SESSION['nome'], $_SESSION['cpf']);

header("Location: login.php");
exit;
