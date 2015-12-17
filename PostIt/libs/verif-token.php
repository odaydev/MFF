<?php
session_start();
include 'verif.class.php';
include '../includes/functions.php';

$db = new connect('mff');
$pdo = $db->getPDO();

if(isset($_GET['to'])) $token = $_GET['to']; else $token = "";
if(isset($_GET['i'])) $lastId = $_GET['i']; else $lastId = "";

$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$lastId]);

$user = $req->fetch(PDO::FETCH_OBJ);

$date = time();

if(($user->created_ts+60*60) < $date){

	$req = $pdo->prepare('DELETE FROM users WHERE id = ?');
	$req->execute([$user->id]);
	$return[0] = 3;
	$return[1] = "Le delais d'activation du lien est dépassé ! ";
}else{
	if($user->token == $token){
		$req = $pdo->prepare('UPDATE users SET token = "", created_ts = 0 WHERE id = ?');
		$req->execute([$user->id]);
		$return[0] = 1;
		$return[1] = "Votre compte a bien été crée ! ";
		$_SESSION['id'] = $user->id;
		$_SESSION['auth'] = $user->login;
		$_SESSION['mail'] = $user->email;

	}else{
		$req = $pdo->prepare('DELETE FROM users WHERE id = ?)');
		$req->execute([$user->id]);
		$return[0] = 2;
		$return[1] = "Erreur lors de votre confirmation ! ";
	}
}
//debug($return,1);
displayInfo($return);
header("Location:../index.php");