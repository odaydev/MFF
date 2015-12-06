<?php
session_start();

include '../includes/functions.php';

if(isIsset($_POST) == "true"){

	require_once 'verif.class.php';

	$db = new connect('mff');
	$pdo = $db->getPDO();



	$mail_forget = $_POST['mail-forget'];

	$req = $pdo->prepare('SELECT email FROM users WHERE email = ?');
	$req->execute([$mail_forget]);

	$champ = $req->fetch(PDO::FETCH_OBJ);

	if($champ->email == ""){
		$return[0] = 2;
		$return[1] = "Votre adresse n'est pas présente dans notre base donnée ! ";
	}
	else{
		$return[0] = 3;
		$return[1] = "Votre adresse est reconnu vous pouvez changer votre mot de passe ! ";	
	}
}else{
	$return[0] = 2;
	$return[1] = "Veuillez remplir le champ ! ";
}


displayInfo($return);
if($return[0] == 3) die(header("Location:../forget-mdp.php")); else die(header("Location:../forget.php"));

?>
