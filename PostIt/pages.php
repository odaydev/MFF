<?php include 'includes/header.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php
if(isset($_GET['idpost'])) $idpost = intval($_GET['idpost']); else $idpost = "";
if(isset($_GET['rech'])) $rech = $_GET['rech']; else $rech = "";

?>

<div class="page-content pages clearfix animsition">

	<div class="topics page-content-centered">

		<h2>Selectionner un post</h2>
		<div id="topic-center" class="clearfix">
			<div id="pag">
			<?php
			if(!empty($rech)){

				$sql = "SELECT * 
				FROM post p 
				WHERE p.keywords LIKE :keyword 
				OR p.title_post LIKE :keyword
				OR p.categorie LIKE :keyword";

				$statement = $pdo->prepare($sql);

				$statement->execute([
					':keyword' => '%' . $rech . '%'
					]);

				$posts = $statement->fetchAll(PDO::FETCH_OBJ);
				$attr = 1;
			}else{

				if($idpost != ""){

					$req1 = $pdo->prepare('SELECT * FROM post WHERE id >= ? AND id <= ? ORDER BY created DESC'); 
					$req1->execute([$idpost,$idpost+8]);
					$posts = $req1->fetchAll(PDO::FETCH_OBJ);

					$req2 = $pdo->prepare('SELECT users.login, users.photo FROM users WHERE users.id = ?');
					$attr = $idpost;

				}else{
					$req1 = $pdo->prepare('SELECT * FROM post ORDER BY created DESC'); 			
					$req1->execute([]);
					$posts = $req1->fetchAll(PDO::FETCH_OBJ);

					$req2 = $pdo->prepare('SELECT users.login, users.photo FROM users WHERE users.id = ?');
					$attr = 1;				
				}
			}
			$count = count($posts);

			for($i=0;$i<$count;$i++){

				$id = $posts[$i]->creator_id;
				if(!empty($rech)){
	
					$req2 = $pdo->prepare('SELECT users.login, users.photo FROM users WHERE users.id = ?');
					$req2->execute([$id]);					
					$info_creator = $req2->fetch(PDO::FETCH_OBJ);
				}else{
					$req2->execute([$id]);
					$info_creator = $req2->fetch(PDO::FETCH_OBJ);
				}
				?>
				
				<article class="topics-box" id="<?=$attr;?>">

					<div class="always-visible clearfix">
						<a href="content.php?idpost=<?=$posts[$i]->id;?>"><img class="topic-img" src="<?=$posts[$i]->image_post;?>"/></a>
						<h2><a href="content.php?idpost=<?=$posts[$i]->id;?>"><?=$posts[$i]->title_post;?></a></h2>
						<h3>
							<img src="img/<?=$info_creator->photo;?>" alt="<?=$posts[$i]->title_post;?>" height="32" width="32"/>
							<a href="profil.php?id=<?=$id;?>"><?=$info_creator->login;?></a>
						</h3>
						<h4><?=dateFormatFR($posts[$i]->created,2);?></h4>
					</div>
					<?php //substr($posts[$i]->texte_post,0,180);echo"...";?>

				</article>

				<?php } ?>
			</div>
			</div>
		</div>
		<div id="loadmore" class="load">
			<!-- <i class="fa fa-spinner fa-pulse fa-3x"></i>  -->
		</div>
		<div class="holder">
			
		</div>
		
	</div>
	<?php include 'includes/footer.php'; ?>