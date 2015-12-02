<?php
session_start();


if($_POST['login'] == null || $_POST['psw'] == null){
	$_SESSION['error'] = "Remplir tous les champs pour vous authentifier ! ";
	die(header("Location:../index.php"));
}
else{
	
	$pdo = include '../conf/pdo.php';
	$login = $_POST['login'];
	$psw = hash('md5',$_POST['psw']);

	$req = $pdo->prepare("SELECT * FROM users WHERE login = ?");
	$req->execute([$login]);
	$user = $req->fetch(PDO::FETCH_OBJ);
	
	if(!empty($user)){

		$psw_verif = $user->password;
		$login_verif = $user->login;
		$mail = $user->email;
		
		if($psw_verif == $psw && $login_verif == $login){
			$_SESSION['auth'] = $login;
			$_SESSION['mail'] = $mail;
			$_SESSION['success'] = "Vous êtes bien authentifié ! ";
			die(header("Location:../index.php"));
		}
		else{
			$_SESSION['error'] = "Le couple Login/MDP ne correspont pas dans notre base de données ! ";
			die(header("Location:../index.php"));
		}
	}else{
		$_SESSION['error'] = "Le couple Login/MDP ne correspont pas dans notre base de données ! ";
		die(header("Location:../index.php"));
	}
}