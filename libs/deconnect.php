<?php
session_start();

require_once('verif.class.php');
	
$db = new connect('mff');	
$pdo = $db->getPDO();

$req = $pdo->prepare('UPDATE users SET last_connexion = NOW() WHERE id = ?');
$req->execute([$_SESSION['id']]);

session_destroy();

$_SESSION["success"] = "Vous êtes bien déconneté !";

header("Location:../index.php");