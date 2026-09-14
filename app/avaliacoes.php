<?php

function buscarAvaliacoes($produto, $server, $user, $password, $db){

    require_once "DLL.php";

    $produto = addslashes($produto);

    $consulta = "
        SELECT * 
        FROM avaliacoes
        WHERE produto = '$produto'
    ";

    return banco(
        $server,
        $user,
        $password,
        $db,
        $consulta
    );

}

?>