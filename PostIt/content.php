<?php  include 'includes/header.php';  ?>
<?php
include 'includes/functions.php';
if(isIsset($_GET)){

		//////////// --> Récupère le post courant <-- ////////////
	$id = $_GET['idpost'];
	$req = $pdo->prepare('SELECT * FROM post WHERE id = ?');
	$req->execute([$id]);
	$post = $req->fetch(PDO::FETCH_OBJ);

		//////////// --> Récupère le créateur du post courant <-- ////////////
	$req1 = $pdo->prepare('SELECT * FROM users WHERE id = ?');
	$req1->execute([$post->creator_id]);
	$creator_post = $req1->fetch(PDO::FETCH_OBJ);

		//////////// --> Récupère les commentaires du post courant <-- ////////////
	$req2 = $pdo->prepare('SELECT * FROM commentaires WHERE id_post = ?');
	$req2->execute([$post->id]);
	$com = $req2->fetchAll(PDO::FETCH_OBJ);

		//////////// --> Récupère tous les id posts pr la navigation latéral <-- ////////////
	$req3 = $pdo->prepare('SELECT id FROM post ORDER BY id ASC');
	$req3->execute([]);
	$posts = $req3->fetchAll(PDO::FETCH_OBJ);

	$nb_posts = count($posts);

		//////////// --> Récupère le post courant <-- ////////////
	$req4 = $pdo->prepare('SELECT * FROM users WHERE id = ?');			

	$tab_ids = array();
	for($i=0;$i<$nb_posts;$i++){
		$tab_ids[$i] = $posts[$i]->id;
	}
		$nav = nav_pages($tab_ids,$post->id,$pdo,$nb_posts);
		
}
?>
	<section class="content animsition-link clearfix">
		<nav class="nav-slide">
			<?php if($nav[1] != $nb_posts){ ?>
			<a href="content.php?idpost=<?=$nav[1];?>" class="prev animsition-link" data-animsition-out-class="fade-out-right" data-animsition-out-duration="2000">
				<i class="fa fa-chevron-right fa-3x"></i>
			</a>
			<?php } ?>
			<?php if($nav[0] != 0){ ?>
			<a href="content.php?idpost=<?=$nav[0]?>" class="next animsition-link" data-animsition-out-class="fade-out-left" data-animsition-out-duration="2000">
				<i class="fa fa-chevron-left fa-3x"></i>
			</a>
			<?php } ?>
		</nav>
		<div class="content-centered">
			<div class="topic clearfix">
				<figure><img src="<?=$post->image_post;?>"></figure>
				<article class="clearfix">
					<h2><?=$post->title_post;?></h2>

					<div class="user-comments">
						<img src="img/<?=$creator_post->photo;?>" alt="<?=$creator_post->login;?>" height="64" width="64"/>
						<h2><?=$creator_post->login;?></h2>
						<h4><?=dateFormatFR($post->created,2);?></h4>
					</div>

					<p><?=$post->texte_post;?></p>
				</article>
			</div>
			<!--Commentaires des autres utilisateurs-->
			<aside class=" comments-submit clearfix">
				<h2>Commentaires</h2>
				<?php if(isset($_SESSION['auth'])){ ?>
				<form action="post_comm.php?id_p=<?=$post->id;?>&id_c=<?=$_SESSION['id'];?>" method="POST" id="form-comm">
					<textarea placeholder="Ajouter un commentaire" name="text-comm"></textarea>
					<input type='hidden' value="<??>"/>
					<input type="submit" name="comment" value="Envoyer" />						
				</form>
				<?php }else{echo "Il faut être logger pour poster un commentaire !";} ?>
			</aside>
			<div class="comments clearfix">

				<?php
				$count = count($com);

				for($i=0;$i<$count;$i++){

					$req4->execute([$com[$i]->creator_id]);
					$creator_com = $req4->fetch(PDO::FETCH_OBJ);
					?>

					<article class="comments-box clearfix">
						<div class="user-comments">
							<div id="id-user-box">
								<img src="img/<?=$creator_com->photo;?>" alt="<?=$creator_com->login;?>" height="64" width="64"/>
								<h2><?=$creator_com->login;?></h2>
								<h4><?=$com[$i]->created;?></h4>
							</div>
						<p><?=$com[$i]->texte_commentaire;?></p>
					</article>
					<?php }  ?>	
				</div>
		</div>
	</section>

<?php  include 'includes/footer.php';  ?>
