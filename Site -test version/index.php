<?php include 'includes/header.php'; ?>
<?php 
	include 'includes/functions.php';

	//$id = $_GET['idpost'];
	$req = $pdo->prepare('SELECT * FROM post ORDER BY created DESC LIMIT 8');
	$req->execute();
	$post = $req->fetchALL(PDO::FETCH_OBJ);

	
	$count = count($post);
	//debug($post,1);
?>

		<section id="main-part" class="clearfix animsition ">

		<?php  
			for($i=0;$i<$count;$i++){  



				$req1 = $pdo->prepare('SELECT * FROM users WHERE id = ?');
				$req1->execute([$post[$i]->creator_id]);
				$creator_post = $req1->fetch(PDO::FETCH_OBJ);

				$req2 = $pdo->prepare('SELECT * FROM commentaires WHERE id_post = ?');
				$req2->execute([$post[$i]->id]);
				$com = $req2->fetchAll(PDO::FETCH_OBJ);
				$nb_com = count($com);
			?>
			<figure class="img-content">
					<img src="<?=$post[$i]->image_post;?>" alt="" width="100%" height="100%" />
				<figcaption class="hover-description">
					<div class="centered">
						<div class="always-visible clearfix">
							<h2><?=$post[$i]->title_post;?></h2>
							<img src="img/<?=$creator_post->photo;?>" id="toficon" alt="<?=$creator_post->login;?>"/>
							<p><?=$creator_post->login;?></p>
							<img src="img/heart-icon.png" id="hearticon" alt="j'aime" height="16" width="14"/>
							<p id="like"></p>
							<img src="img/message-icon.png" id="messageicon"alt="<?=$nb_com;?>commentaire" height="16" width="14"/>
							<p><?=$nb_com;?></p>
						</div>
						<!--Contenu caché, apparait au survol-->
						<div class="hidden-content clearfix">
							<p><?=$post[$i]->texte_post;?></p>
						</div>
						<a class="more-btn" href="content.php?idpost=<?=$post[$i]->id;?>">Read More</a>
					</div>
				</figcaption>
			</figure>
			<?php } ?>
			
		</section>
		
<?php include 'includes/footer.php';  ?>