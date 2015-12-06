
<?php
session_start();
include 'includes/functions.php';
include 'libs/verif.class.php';

$db = new connect('mff');	
$pdo = $db->getPDO();

if(isset($_SESSION['id'])) {
	$id = $_SESSION['id'];
} else {
	$id = 0;
}

//debug($id,1);
$creator = $id;





if (isIsset($_POST) == "true") {
//voir https://openclassrooms.com/forum/sujet/insertion-d-une-image-dans-une-base-de-donnee

	$categorie = $_POST['categories'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	$meta = $_POST['keywords'];
	$date = date('Y-m-d H:i:s');

	/*upload image*/
	$extensions = array('.png', '.jpg', '.jpeg', '.gif');
	$extension = strrchr($_FILES['fichier']['name'], '.');

	if (in_array($extension, $extensions)){
		
		$fichier = basename($_FILES['fichier']['name']);
		$dossier = "img/";
		$target = $dossier.$fichier;
		//debug($target,1);
		
		$tmp_name = $_FILES['fichier']['tmp_name'];
		//$target = 'user_img\\' . uniqid() . '-' . $_FILES['fichier']['name'];
		//move_uploaded_file($tmp_name, $target);

		if(move_uploaded_file($tmp_name, $target)) {

			$sql = "INSERT INTO post (id,categorie,title_post,image_post,texte_post,creator_id,created,keywords) 
			VALUES ('',?,?,?,?,?,?,?)";
			// debug($creator,1);
			$statement = $pdo->prepare($sql);
			$statement->execute([$categorie, $title, $target, $message, $creator, $date, $meta]);

			$return[0] = 1; 
			$return[1] = "Votre post a bien été envoyé ! ";
		}else{
			$return[0] = 2; 
			$return[1] = "L'upload de l'image a échoué.";
		}

		
	} else {
		$return[0] = 2; 
		$return[1] = "Extension non autorisée !"; 
	}	

} else { 
	$return[0] = 2; 
	$return[1] = "Veuillez remplir tous les champs ! ";	
}


displayInfo($return);
header('Location: addcontent.php');
