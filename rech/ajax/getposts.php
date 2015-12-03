<?php

	//connexion à la bdd
	require("db_mff.php"); //crée notre variable $pdo

	//récupère les mots-clefs envoyés dans la requête AJAX
	$kw = $_GET['kw'];

	//requête SQL de recherche
	$sql = "SELECT id, texte_post, creator_id, created FROM post 
			WHERE title_post LIKE :keyword";
	
	$statement = $pdo->prepare($sql);

	//exécution de la requête en remplacant les paramètres nommés
	//on ajoute les pourcentages pour recherche la chaîne n'importe où
	$statement->execute([
		':keyword' => '%' . $kw . '%'
	]);

	//récupère les résultats
	$posts = $statement->fetchAll();

	//boucle sur les résultats afin de générer du HTML à renvoyer en réponse
	foreach($posts as $post){
	?>

		<a href="#<?= $post['id'] ?>" title="<?= $post['title_post'] ?>">
			<img src="img/<?= $post['image_post'] ?>" alt="<?= $post['title_post'] ?>">
		</a>
	
	<?php
	} //fin du foreach
	?>