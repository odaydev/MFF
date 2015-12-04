<?php session_start(); ?>
<?php
include 'verif.class.php';
include '../../inc/functions.php';

$db = new connect('mff');
$pdo = $db->getPDO();

if(isset($_POST['psw1']) && isset($_POST['psw2'])){
	if($_POST['psw1'] != "" && $_POST['psw2'] != ""){
		//debug($_POST,true);
		$psw1 = $_POST['psw1'];
		$mail = $_POST['mail'];
		if($psw1 == $_POST['psw2']){
			$psw = hash("md5",$psw1);
		//debug($psw,true);
			$req1 = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
			$req1->execute([$psw,$mail]);
			$_SESSION['success'] = "Votre mot de passe a bien été modifié ! Un email va vous être envoyé ! Vous pouvez dès à présent vous connecter ! ";
			die(header("Location:../index.php")); 

		}else{
		//debug("ee",true);
			$_SESSION['error'] = "Les deux champs ne correspondent pas ! "; 
			die(header("Location:../forget.php?on=1"));
		}
	}else{
				//debug("aa",true);

		$_SESSION['error'] = "Veuillez renseigner correctement tous les champs ! "; 
		die(header("Location:../forget.php?on=1"));
	}
}