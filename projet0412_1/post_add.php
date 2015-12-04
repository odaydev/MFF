
<?php
include 'includes/functions.php';
 	if(isset($_SESSION['auth'])) {
	 	require_once('libs/verif.class.php');
		
		$db = new connect('mff');	
		$pdo = $db->getPDO();
		
		if(isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
			} else {
				$id = 0;
			}
		
		$user = new verif($id,$pdo);
		$creator = $id; 
	}
// include 'libs/verif.class.php';


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
	//$extensions = explode('.', $_FILES['fichier']['name']);
	//$extension = end($extensions);
	$fichier = basename($_FILES['fichier']['name']);
	$dossier = "/user_img";
	$target = $dossier . $fichier . $extension;

	if ( !in_array($extension, $extensions) ){
		$return[0] = 2; 
		$return[1] = "Extension non autorisée !";
	} else {

		$tmp_name = $_FILES['fichier']['tmp_name'];
		//$target = 'user_img\\' . uniqid() . '-' . $_FILES['fichier']['name'];
		//move_uploaded_file($tmp_name, $target);

		if(move_uploaded_file($tmp_name, $dossier)) {

			/*Requete*/
			$pdo = new PDO('mysql:host=localhost;dbname=postit', 'root');
			$sql = "INSERT INTO post (creator_id, categorie, title_post, image_post, texte_post, created, keywords) 
			VALUES (?, ?, ?, ?, ?, ?, ?);";

			$statement = $pdo->prepare($sql);
			$statement->execute([$creator, $categorie, $title, $target, $message, $date, $meta]);

			$return[0] = 1; 
			$return[1] = "Votre post a bien été envoyé ! ";
			}
			else {
				$return[0] = 2; 
				$return[1] = "L'upload de l'image a échoué.";
			}

		} 
	} else {
		$return[0] = 2; 
		$return[1] = "Veuillez remplir tous les champs ! "; 
}

displayInfo($return);
header('Location: addcontent.php');
