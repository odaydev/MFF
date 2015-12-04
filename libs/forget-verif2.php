<?php session_start(); ?>
<?php
include 'verif.class.php';
include '../includes/functions.php';

$db = new connect('mff');
$pdo = $db->getPDO();

if(isIsset($_POST) == "true"){
		//debug($_POST,true);
		$psw1 = $_POST['psw1'];
		$mail = $_POST['mail'];
		if($psw1 == $_POST['psw2']){
			$psw = hash("md5",$psw1);
		//debug($psw,1);
			$req1 = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
			$req1->execute([$psw,$mail]);

			$return[0] = 1;
			$return[1] = "Votre mot de passe a bien été modifié ! Un email va vous être envoyé ! Vous pouvez dès à présent vous connecter ! ";				

		}else{
		//debug("ee",true);
			$return[0] = 2;
			$return[1] = "Les deux champs ne correspondent pas ! ";			
		}
}else{
				//debug("aa",true);

	$return[0] = 2;
	$return[1] = "Veuillez renseigner correctement tous les champs ! ";
}


displayInfo($return);
if($return[0] == 1) die(header("Location:../index.php")); else die(header("Location:../forget-mdp.php"));


