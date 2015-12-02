<?php
session_start();
$pdo = include '../conf/pdo.php';
include '../../inc/functions.php';

if($_POST['login'] == null || $_POST['psw'] == null || $_POST['mail'] == null || $_POST['phone'] == null || $_POST['psw_rewrite'] == null || $_POST['birthday'] == null){
	$_SESSION['error'] = "Remplir tous les champs pour vous inscrire ! ";
	die(header("Location:../index.php"));
}else{
	$login = $_POST['login'];
	$email = $_POST['mail'];
	$phone = $_POST['phone'];
	$birthday = $_POST['birthday'];
	$psw = $_POST['psw'];
	$psw2 = $_POST['psw_rewrite'];
}

$req_log = $pdo->prepare('SELECT * FROM users WHERE login = ?');
$req_mail = $pdo->prepare('SELECT * FROM users WHERE email = ?');

$req_log->execute([$login]);
$result_log = $req_log->fetch(PDO::FETCH_OBJ);

$req_mail->execute([$email]);
$result_mail = $req_mail->fetch(PDO::FETCH_OBJ);


if(!empty($result_log)){
	if($result_log->login == $login){
		$_SESSION['error'] = "Ce login existe déjà. Veuillez en choisir un autre ! ";
		die(header("Location:../index.php"));
	}
}

if(!empty($result_mail)){
	if($result_mail->email == $email){
		$_SESSION['error'] = "Cette adresse mail correspond déjà à un compte sur notre site ! ";
		die(header("Location:../index.php"));
	}
}

if($psw != $psw2){
	$_SESSION['error'] = "Les mots de passes ne correspondent pas ! ";
	die(header("Location:../index.php"));
}else{
		
	$hash = hash('md5', $psw);
	$token = str_random(60);
	$created_ts = time();
	//debug($token,true);
	try{
		$req_insert = $pdo->prepare('INSERT INTO users (id,login,email,phone,password,birthday,created,created_ts,confirmation_token,confirmed_at) VALUES ("",?,?,?,?,?,NOW(),?,?,"")');
		$req_insert->execute([$login,$email,$phone,$hash,$birthday,$created_ts,$token]);
		$_SESSION['success'] = "Votre compte à bien été créer ! ";
		//die(header('Location:../index.php'));
	}catch(PDOException $Exception){
		$Exception->getMessage;	
	}
	$id = $pdo->lastInsertId();
	//debug($id,1);
	$lien = '<a href="http://localhost/formation/forum/libs/verif-token.php?to='.$token.'&i='.$id.'">http://localhost/formation/forum/libs/verif-token.php</a>';
	$msg = "Pour pouvoir confirmer l'activation de votre compte sur le forum WF3 pour le compte de ".$login.". Veuillez cliquer sur le lien suivant qui vous redirigera vers notre site<br/><br/>".$lien;
	require_once 'mail.php';
	$result = smtpmailer($email, 'oday972@gmail.com', 'OD@Y', 'Vérification de la création de compte WF3', $msg);
	if (true !== $result){
		// erreur -- traiter l'erreur
		echo $result;
		die();
	}
}


