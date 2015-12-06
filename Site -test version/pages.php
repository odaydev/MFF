<?php include 'includes/header.php'; ?>
<?php include 'includes/functions.php'; ?>

<div class="page-content pages clearfix animsition">

	<div class="topics page-content-centered">

		<h2>Selectionner un post</h2>
			<div id="topic-center" class="clearfix ">
				<?php

					$req1 = $pdo->prepare('SELECT * FROM post ORDER BY created DESC LIMIT 0,32');				
					$req1->execute();
					$posts = $req1->fetchAll(PDO::FETCH_OBJ);
			
					$req2 = $pdo->prepare('SELECT users.login, users.photo FROM users WHERE users.id = ?');

					$count = count($posts);

					for($i=0;$i<$count;$i++){
						
						$id = $posts[$i]->creator_id;
						$req2->execute([$id]);
						$info_creator = $req2->fetch(PDO::FETCH_OBJ);
				?>

						<article class="topics-box clearfix">

								<div class="always-visible clearfix">
									<a href="content.php?idpost=<?=$posts[$i]->id;?>"><img class="topic-img" src="<?=$posts[$i]->image_post;?>"/></a>
									<h2><a href="content.php?idpost=<?=$posts[$i]->id;?>"><?=$posts[$i]->title_post;?></a></h2>
									<h3><a href="profil.php?id=<?=$id;?>"><?=$info_creator->login;?></a></h3>
									<img src="img/<?=$info_creator->photo;?>" alt="<?=$posts[$i]->title_post;?>" height="16" width="16"/>
									<h4><?=dateFormatFR($posts[$i]->created,2);?></h4>
								</div>
								<p><?=$posts[$i]->texte_post;?></p>
							
						</article>

				<?php } ?>
		</div>
	</div>

</div>
		<?php include 'includes/footer.php'; ?>