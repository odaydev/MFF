<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Recherche de posts</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="css/reset.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>

	<div class="container">

		<header class="clearfix">

			<h1>Posts lookup</h1>
			<form id="search-form" method="GET">
				<input type="search" name="kw" id="kw-input" placeholder="Posts..." />
				<input type="submit" value="OK">
			</form>

		</header>

		<!-- contiendra les livres issus de la requête AJAX -->
		<section id="posts-container"></section>

	</div>

	<script src="js/jquery-2.1.4.js"></script>
	<script src="js/main_rech.js"></script>
</body>
</html>
