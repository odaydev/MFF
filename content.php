<?php  include 'includes/header.php';  ?>
<?php
include 'includes/functions.php';
	if(isIsset($_GET)){
		$id = $_GET['id'];
		$req = $pdo->prepare('SELECT * FROM post WHERE id = ?');
		$req->execute([$id]);
		$post = $req->fetch(PDO::FETCH_OBJ);

		$req1 = $pdo->prepare('SELECT * FROM users WHERE id = ?');
		$req1->execute([$post->creator_id]);
		$creator = $req1->fetch(PDO::FETCH_OBJ);

		//debug($creator,1);
	}
?>
		<section class="content clearfix">
			<div class="content-centered">
				<div class="topic clearfix">
					<figure><img src="img/<?=$post->image_post;?>" height="480" width="480"></figure>
					<article class="clearfix">
						<h2><?=$post->title_post;?></h2>

						<div class="user-comments">
							<img src="img/<?=$creator->photo;?>" alt="<?=$creator->login;?>" height="64" width="64"/>
							<h2><?=$creator->login;?></h2>
							<h4><?=dateFormatFR($post->created,2);?></h4>
						</div>

						<p><?=$post->texte_post;?></p>
					</article>
				</div>
				<!--Commentaires des autres utilisateurs-->
				<aside class=" comments-submit clearfix">
					<h2>Commentaires</h2>
					<?php if(isset($_SESSION['auth'])){ ?>
					<form action="post_comm.php" method="POST" id="form-comm">
					<textarea placeholder="Ajouter un commentaire" name="text-comm"></textarea>
					<input type='hidden' value="<??>"/>
					<input type="submit" name="comment" value="Envoyer" />						
					</form>
					<?php }else{echo "Il faut être logger pour poster un commentaire !";} ?>
				</aside>
				<div class="comments clearfix">
					<article class="comments-box clearfix">
						<div class="user-comments">
							<img src="img/user1.png" alt="nom de la personne" height="64" width="64"/>
							<h2>User's name</h2>
							<h4>02 Decembre 2015</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
					</article>
					<article class="comments-box clearfix">
						<div class="user-comments">
							<img src="img/user1.png" alt="nom de la personne" height="64" width="64"/>
							<h2>User's name</h2>
							<h4>02 Decembre 2015</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
					</article>
					<article class="comments-box clearfix">
						<div class="user-comments">
							<img src="img/user1.png" alt="nom de la personne" height="64" width="64"/>
							<h2>User's name</h2>
							<h4>02 Decembre 2015</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
					</article>
				</div>
			</div>
		</section>


	<?php  include 'includes/footer.php';  ?>
