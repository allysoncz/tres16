<?php

session_start();

include "app/cons.php";
require_once "app/DLL.php";

if(!isset($_SESSION['usuario'])){

    header("Location: login.php");
    exit;
}

$usuario = addslashes($_SESSION['usuario']);

$id = isset($_POST['id'])
? intval($_POST['id'])
: -1;

if($id > 0){

    $consulta = "DELETE FROM carrinho WHERE Id = $id and usuario = '$usuario'";

    banco($server, $user, $password, $db, $consulta);
}

header("Location: carrinho.php");

exit;
