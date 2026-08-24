<?php
session_start();
unset($_SESSION['usuario'], $_SESSION['cpf']);
session_destroy();
header("Location: index.php");
exit;
