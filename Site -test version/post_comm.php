<?php
session_start();
include 'includes/functions.php';
include 'libs/verif.class.php';

if(isIsset($_POST) == "true"){
	
	if(isIsset($_GET)){

		$id_post = $_GET['id_p'];	
		$id = $_GET['id_c'];	

		$db = new connect('mff');
		$pdo = $db->getPDO();


		$text = $_POST['text-comm'];
//debug($id,1);
		$req = $pdo->prepare('INSERT INTO commentaires (id,id_post,creator_id,texte_commentaire,created) VALUES ("",?,?,?,NOW())' );
		$req->execute([$id_post,$id,$text]);
	}else{
		$return[0] = 3;
		$return[1] = "Une erreur est survenue ! ";
	}
	

}else{

	$return[0] = 2;
	$return[1] = "Veuillez remplir le champ ! ";
}

displayInfo($return);
header("Location:content.php?idpost=$id_post#form-comm");
?>