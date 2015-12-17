<?php
session_start();
header('Content-type: application/json');
	//connexion à la bdd
	require_once('../libs/verif.class.php');
	require('../includes/functions.php');
	$db = new connect('mff');	
	$pdo = $db->getPDO();
	//récupère les mots-clefs envoyés dans la requête AJAX
	$kw = $_GET['kw'];

	//requête SQL de recherche
	$sql = "SELECT * 
			FROM  post p 
			WHERE p.keywords LIKE :keyword 
			OR p.title_post LIKE :keyword
			OR p.categorie LIKE :keyword";
	
	$statement = $pdo->prepare($sql);

	//exécution de la requête en remplacant les paramètres nommés
	//on ajoute les pourcentages pour recherche la chaîne n'importe où
	$statement->execute([
		':keyword' => '%' . $kw . '%'
	]);

	//récupère les résultats
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	print_r(json_encode($posts));

	?>
