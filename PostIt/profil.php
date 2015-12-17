<?php include 'includes/header.php'; ?>
<?php require_once 'includes/functions.php'; ?>

<?php 

$date_inscription = dateFormatFR($user->inscription,1); 
$date_birthday = dateFormatFR($user->birthday);
$date_last_connect = dateFormatFR($user->last_connexion,2);

?>

<section class="page-content profil clearfix">
	<article class="users-panel">
		<div class="info-box dark">
			<img src="img/<?=$user->photo;?>" style="width:65px;height:65px;border-radius:50%"/>

			<?php
			if(isset($_SESSION['auth'])){
				if($_SESSION['auth'] == $user->login){

					?>
					<a href="">Modifier la photo</a>
					<input id="tof" type="file" placeholder="photo" name="photo" value="" />
					<?php } }  ?>
				</div>
				<div class="info-box dark">
					<h4><?=$user->login?></h4>
					<?php
					if(isset($_SESSION['auth'])){
						if($_SESSION['auth'] == $user->login){			
							?>	
							<a href="">Modifier le pseudo</a>
							<input type="text" placeholder="pseudo" name="pseudo" value="" />
							<?php } }  ?>
						</div>
						<div class="info-box">
							<h4><?=$user->email?></h4>
							<?php
							if(isset($_SESSION['auth'])){
								if($_SESSION['auth'] == $user->login){		
									?>
									<a href="">Modifier l'adresse mail</a>
									<input type="text" placeholder="email" name="email" value="" />
									<?php } }  ?>
								</div>
								<div class="info-box">
									<h4><?=$date_birthday;?></h4>
									<?php
									if(isset($_SESSION['auth'])){
										if($_SESSION['auth'] == $user->login){			
											?>
											<a href="">Modifier la date de naissance</a>
											<input type="date" placeholder="birthday" name="birthday" value=""/>
											<?php } }  ?>
										</div>
										<div class="info-box">
											<h4>**************</h4>
											<?php
											if(isset($_SESSION['auth'])){
												if($_SESSION['auth'] == $user->login){			
													?>
													<a href="">Modifier le mot de passe</a>
													<input type="password" placeholder="old password" name="user[oldpassword]" />
													<input type="password" placeholder="new password" name="user[newpassword]" />
													<?php } }  ?>
												</div>
												<div class="info-box meta">
													<h4>Post de <?=$user->login;?> :</h4>
													<ul class="meta-info">
														<br/>
														<?php
															$req = $pdo->prepare('SELECT p.title_post, p.created FROM post p WHERE p.creator_id = ?');
															$req->execute([$user->id]);
															$posts = $req->fetchAll(PDO::FETCH_OBJ);
															//debug($posts,1);
															$count = count($posts);
															for($i=0;$i<$count;$i++){
														?>
														<li><?=dateFormatFR($posts[$i]->created,2);?>  <?=$posts[$i]->title_post;?></li>
														<?php
															}
														?>
													</ul>
												</div>
												<div class="info-box meta">
													<?php
														$req1 = $pdo->prepare('SELECT COUNT(id) as nbcoms FROM commentaires WHERE creator_id = ?');
														$req1->execute([$user->id]);
														$nbcoms = $req1->fetch(PDO::FETCH_OBJ);
													?>
													<h4>Nombre de commentaires : <?=$nbcoms->nbcoms;?></h4>
												</div>
												<div class="info-box meta">
													<h4>Inscrit depuis le <?=$date_inscription;?></h4>
												</div>
												<div class="info-box meta">
													<h4>Dernière connexion le <?=$date_last_connect;?></h4>
												</div>

												<?php
												if(isset($_SESSION['auth'])){

													$req1 = $pdo->prepare('SELECT statut FROM amis WHERE id_from = ? AND id_to = ?');
														$req1->execute([$user->id,$_SESSION['id']]);
														$statut = $req1->fetch(PDO::FETCH_OBJ);

														if(empty($statut)){
															$req2 = $pdo->prepare('SELECT statut FROM amis WHERE id_from = ? AND id_to = ?');
															$req2->execute([$_SESSION['id'],$user->id]);
															$statut = $req2->fetch(PDO::FETCH_OBJ);															
														} 													

													?>

														<div class="info-box">
															<h4>Contact</h4>
															<?php
															$req = $pdo->prepare('SELECT u.login, u.id, u.photo, a.statut FROM users u, amis a WHERE u.id = a.id_from AND u.id IN ( SELECT a.id_from FROM amis a WHERE a.id_to = :id)');
															//SELECT u.login, u.id, u.photo, a.statut FROM users u, amis a WHERE u.id = a.id_from AND u.id IN (SELECT a.id_to FROM amis a WHERE a.id_to = 18) OR u.id IN (SELECT a.id_from FROM amis a WHERE a.id_from = 18)
															$req->execute([":id"=>$user->id]);
															$friends = $req->fetchAll(PDO::FETCH_OBJ);


															$count = count($friends);
													//debug($friends);
															for($i=0;$i<$count;$i++){ 
																if($friends[$i]->statut == 2){?>
															<a class="friends" href="?id=<?=$friends[$i]->id;?>"><img src="img/<?=$friends[$i]->photo;?>" style="width:65px;height:65px;border-radius:50%" /><?=$friends[$i]->login;?></a>
															<?php }}?>
														</div>
														<?php 

														if(!isset($statut) && empty($statut) || $statut == "" && isset($_SESSION['auth']) && $_SESSION['id'] != $user->id){
															echo '<button>Ajouter</button>';
														}

													}

														   ?>
												</article>
											</section>

											<?php include 'includes/footer.php'; ?>
