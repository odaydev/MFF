<?php

	//connexion à la bdd
	require("db_mff.php"); //crée notre variable $pdo

	//récupère les mots-clefs envoyés dans la requête AJAX
	$kw = $_GET['kw'];

	//requête SQL de recherche
	$sql = "SELECT u.login, p.texte_post, p.created FROM users u 
			INNER JOIN post p ON u.id = p.creator_id AND p.keywords LIKE :keyword";
	
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
		// print_r ($post);
		echo ("Creator : " . $post['login'] . "\n");
		echo ("Created : " . $post['created'] . "\n");
		echo ($post['texte_post'] . "\n");
	/* ?>
		<img src="img/<?= $post['image_post'] ?>" alt="">
	<?php
	*/
	} //fin du foreach
	?>
