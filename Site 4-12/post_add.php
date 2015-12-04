
<?php

$error = "";
$notError = "";


/*NOTE : le chargement de contenu marche mais pas l'upload d'image dans le dossier user_img et la sauvegarde du chemin dans le BDD*/

if($_POST['submit']){
	$extensions = explode('.', $_FILES['fichier']['name']);
	$extension = end($extensions);
	​
	if(!in_array($extension, ['jpg', 'jpeg', 'gif'])){
		$error= "Extension non authorisée !";				
	}


		$tmp_name = $_FILES['fichier']['tmp_name'];
		$target = 'user_img\\' . uniqid() . '-' . $_FILES['fichier']['name'];
		​
		move_uploaded_file($tmp_name, $target);

		$pdo = new PDO('mysql:host=localhost;dbname=post', 'root');
		$title = $_POST['title'];
		$cat = $_POST['categorie'];
		$keyword = $_POST['meta'];
		$message = $_POST['message'];
		$date = date('Y-m-d H:i:s');


		$sql = "INSERT INTO post ( creator_id, image_post, title_post, texte_post, created, categorie, keywords ) VALUES ( ?, ?, ?, ?, ?, ?, ? );";

		$statement = $pdo->prepare($sql);
		$statement->execute([7, $target, $title, $message, $date, $cat, $keyword ]);

		$notError = "Post!";
	​
}else{ $error = "Le post a échoué!";}

	header('Location: addcontent.php');
