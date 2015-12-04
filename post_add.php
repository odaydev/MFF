
<?php
session_start();
include 'includes/functions.php';
 	//debug($_SESSION,1);
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
		//debug($id,1);
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
	$dossier = "user_img/";
	$target = $dossier.$fichier.$extension;

	/* if ( !in_array($extension, $extensions) ){
		$return[0] = 2; 
		$return[1] = "Extension non autorisée !";
	} else { */

		$tmp_name = $_FILES['fichier']['tmp_name'];
		//$target = 'user_img\\' . uniqid() . '-' . $_FILES['fichier']['name'];
		//move_uploaded_file($tmp_name, $target);

		if(move_uploaded_file($tmp_name, $dossier)) {

			/*Requete*/
			/*include 'libs/verif.class.php';
			$db = new connect('mff');
			$pdo = $db->getPDO();*/
			// $pdo = new PDO('mysql:host=localhost;dbname=postit', 'root');
			$sql = "INSERT INTO post (id,categorie,title_post,image_post,texte_post,creator_id,created,keywords) 
			VALUES ('',?,?,?,?,?,?,?)";
			// debug($creator,1);
			$statement = $pdo->prepare($sql);
			$statement->execute([$categorie, $title, $target, $message, $creator, $date, $meta]);

			$return[0] = 1; 
			$return[1] = "Votre post a bien été envoyé ! ";
			}
			else {
				$return[0] = 2; 
				$return[1] = "L'upload de l'image a échoué.";
			}

		
	} else {
		$return[0] = 2; 
		$return[1] = "Veuillez remplir tous les champs ! "; 
		}

displayInfo($return);
header('Location: addcontent.php');
