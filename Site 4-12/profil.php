<?php include('includes/header.php'); ?>

<section class="page-content profil clearfix">
	<article class="users-panel">
		<div class="info-box dark">
			<img src="img/user1.png" />
			<a href="">Modifier la photo</a>
			<input id="tof" type="file" placeholder="photo" name="user[photo]" value="" />
		</div>
		<div class="info-box dark">
			<h4>Pseudo</h4>
			<a href="">Modifier le pseudo</a>
			<input type="text" placeholder="pseudo" name="user[pseudo]" value="" />
		</div>
		<div class="info-box">
			<h4>Email</h4>
			<a href="">Modifier l'adresse mail</a>
			<input type="text" placeholder="email" name="user[email]" value="" />
		</div>
		<div class="info-box">
			<h4>Birthday</h4>
			<a href="">Modifier la date de naissance</a>
			<input type="date" placeholder="birthday" name="user[birthday]" value=""/>
		</div>
		<div class="info-box">
			<h4>Mot de passe</h4>
			<a href="">Modifier le mot de passe</a>
			<input type="password" placeholder="old password" name="user[oldpassword]" />
			<input type="password" placeholder="new password" name="user[newpassword]" />
		</div>
		<div class="info-box meta">
			<h4>Inscrit depuis le 2/12/2015</h4>
		</div>
		<div class="info-box meta">
			<h4>Dernière connexion le 03/12/2015 à 9:30</h4>
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

<?php include('includes/footer.php'); ?>

