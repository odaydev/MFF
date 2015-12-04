<?php include('includes/header.php'); ?>

<section class="page-content inscription">
	<form id="inscription-form" class="topics-centered" action="" method="POST">
	<aside id="inscription-aside">
		<img src="img/register.png" alt="Shoot | Logo"/>
		<h1>Welcome on Post it !</h1>
	</aside>
	<!--
	<?php if ( $error ) { ?>
	<h2 id="error-label" style="color: red;"><?=$error?></h2>
	<?php } ?>-->
		<label for"photo">Photo</label>
		<input type="hidden" name="MAX_FILE_SIZE" value="12345" />
		<input type="file" placeholder="photo" name="user[photo]" value="" />
		
		<label for="name">Name</label>
		<input type="text" placeholder="name" name="user[name]" value="" />

		<label for="pseudo">Pseudo</label>
		<input type="text" placeholder="pseudo" name="user[pseudo]" value="" />

		<label for="email">Email</label>
		<input type="text" placeholder="email" name="user[email]" value="" />

		<label for="password">Password</label>
		<input type="password" placeholder="password" name="user[password]" />

		<label for="repeatpassword">Repeat password</label>
		<input type="password" placeholder="repeatpassword" name="user[oldpassword]" />

		<label for="birthday">Birthday</label>
		<input type="date" placeholder="birthday" name="user[birthday]" value=""/>


		<input type="submit" name="action[inscription]" value="inscription" />
	</form>
</section>

<?php include('includes/footer.php'); ?>
