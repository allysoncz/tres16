<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

$_POST['login'] = trim($_POST['login'] ?? '');

$u = addslashes($_POST['login']);

$consulta = "SELECT * FROM acesso WHERE usuario = '$u'";
$resultado = banco($server, $user, $password, $db, $consulta);
$linha = $resultado->fetch_assoc();

if(!$linha){
    header("Location: erro.php");
    exit;
}

if(password_verify($_POST['senha'] ?? '', $linha['senha'])){
    $_SESSION['usuario'] = $linha['usuario'];
    $_SESSION['cpf'] = $linha['cpf'];
    header("Location: index.php");
    exit;
}

header("Location: erro.php");
exit;
