<?php
session_start();
include 'includes/functions.php';
include 'libs/verif.class.php';
if(isIsset($_POST) == "true"){
	
	$db = new connect('mff');
	$pdo = $db->getPDO();

	$id = $_SESSION['id'];

	$user = new verif($id,$pdo);
	
	$text = $_POST['text-comm'];

	$req = $pdo->prepare('INSERT INTO commentaires (id,id_post,creator_id,texte_commentaire,created) VALUES (1,?,?,?,NOW())' );
	$req->execute([$id_post,$id,$text]);

	

}else{

	$return[0] = 2;
	$return[1] = "Veuillez remplir le champ ! ";
}

displayInfo($return);
header("Location:content.php#form-comm");
?>