<?php
session_start();
unset($_SESSION['auth']);

setcookie('auth', '', time()-3600*2);

$_SESSION["success"] = "Vous êtes bien déconneté !";
header("Location:index.php");