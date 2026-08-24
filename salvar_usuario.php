<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

$_POST = array_map('trim', $_POST);

$nome = addslashes($_POST['nome'] ?? '');
$cpf = addslashes($_POST['cpf'] ?? '');
$endereco = addslashes($_POST['endereco'] ?? '');
$bairro = addslashes($_POST['bairro'] ?? '');
$cidade = addslashes($_POST['cidade'] ?? '');
$estado = addslashes($_POST['estado'] ?? '');
$cep = addslashes($_POST['cep'] ?? '');

// verifica se o CPF já está cadastrado
$consulta = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
$resultado = banco($server, $user, $password, $db, $consulta);
$linha = $resultado->fetch_assoc();

if($linha){
    $consulta = "UPDATE usuarios SET nome = '$nome', endereco = '$endereco', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep' WHERE cpf = '$cpf'";
    banco($server, $user, $password, $db, $consulta);
}else{
    $consulta = "INSERT INTO usuarios (Id, nome, cpf, endereco, bairro, cidade, estado, cep) VALUES (NULL, '$nome', '$cpf', '$endereco', '$bairro', '$cidade', '$estado', '$cep')";
    banco($server, $user, $password, $db, $consulta);
}

$_SESSION['cpf']  = $_POST['cpf'];
$_SESSION['nome'] = $_POST['nome'];

header("Location: cadastro2.php");
exit;
