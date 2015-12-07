

<?php

	//connexion à la bdd
	require("db_mff.php"); //crée notre variable $pdo

	//récupère les mots-clefs envoyés dans la requête AJAX
	$kw = $_GET['kw'];

	//requête SQL de recherche
	$sql = "SELECT u.login, p.title_post, p.texte_post, p.created, p.id, p.image_post, p.creator_id FROM users u 
			INNER JOIN post p ON u.id = p.creator_id AND p.keywords LIKE :keyword";
	
	$req1 = $pdo->prepare($sql);

	//exécution de la requête en remplacant les paramètres nommés
	//on ajoute les pourcentages pour recherche la chaîne n'importe où
	$req1->execute([
		':keyword' => '%' . $kw . '%'
	]);

	//récupère les résultats
	$posts = $req1->fetchAll();

					
					// $posts = $req1->fetchAll(PDO::FETCH_OBJ);
			
	$req2 = $pdo->prepare('SELECT users.login, users.photo FROM users WHERE users.id = ?');

	$count = count($posts);

					// for($i=0;$i<$count;$i++){
					foreach($posts as $post) {	
						$id = $post['creator_id'];
						$req2->execute([$id]);
						$info_creator = $req2->fetchAll();
				?>

						<article class="topics-box clearfix">

								<div class="always-visible clearfix">
									<a href="content.php?idpost=<?=$post['id'];?>"><img class="topic-img" src="<?=$post['image_post'];?>"/></a>
									<h2><a href="content.php?idpost=<?=$post['id'];?>"><?=$post['title_post'];?></a></h2>
									<h3><a href="profil.php?id=<?=$id;?>"><?=$post['login'];?></a></h3>
									
									<h4><?=$post['created'];?></h4>
								</div>
								<p><?=$post['texte_post'];?></p>
							
						</article>

				<?php } ?>






