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
				<a href="">Modifier la photo</a>
				<input id="tof" type="file" placeholder="photo" name="photo" value="" />
			</div>
			<div class="info-box dark">
				<h4><?=$user->login?></h4>
				<a href="">Modifier le pseudo</a>
				<input type="text" placeholder="pseudo" name="pseudo" value="" />
			</div>
			<div class="info-box">
				<h4><?=$user->email?></h4>
				<a href="">Modifier l'adresse mail</a>
				<input type="text" placeholder="email" name="email" value="" />
			</div>
			<div class="info-box">
				<h4><?=$date_birthday;?></h4>
				<a href="">Modifier la date de naissance</a>
				<input type="date" placeholder="birthday" name="birthday" value=""/>
			</div>
			<div class="info-box">
				<h4>**************</h4>
				<a href="">Modifier le mot de passe</a>
				<input type="password" placeholder="old password" name="user[oldpassword]" />
				<input type="password" placeholder="new password" name="user[newpassword]" />
			</div>
			<div class="info-box meta">
				<h4>Inscrit depuis le <?=$date_inscription;?></h4>
			</div>
			<div class="info-box meta">
				<h4>Dernière connexion le <?=$date_last_connect;?></h4>
			</div>
			<div class="info-box">
				<h4>Contact</h4>
				<a class="friends" href="Profil-user1">User 1</a>
				<a class="friends" href="Profil-user2">User 2</a>
				<a class="friends" href="Profil-user3">User 3</a>
				<a class="friends" href="Profil-user450">User 450</a>
				<a class="friends" href="Profil-user560">User 560</a>
			</div>
		</article>
	</section>

	<?php include 'includes/footer.php'; ?>
