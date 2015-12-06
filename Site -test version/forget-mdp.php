<?php 
include 'includes/header.php';
?>
<div class="page-content clearfix">
	<p>Par soucis de sécurité nous ne stockons aucune données sensibles en clair dans notre base de données. Par conséquent nous ne pouvons pas vous restituer votre mot de passe actuelle.</p>
	<p>Veuillez en entrer un nouveau, le retenir et ne plus me faire chier avec ça!!</p>
	<p>Merci!!!! ['OD@Y']</p>

	<form class="form-horizontal" action="libs/forget-verif2.php" method="POST">
		<label class="class-label">Mot de passe</label>
		<input type="password" class="class-control" name="psw1">

		<label class="class-label">Mot de passe 2</label>
		<input type="password" class="class-control" name="psw2">
		<input type="hidden" class="class-control" name="mail" value="<?=$mail_forget;?>">
		<button type="submit" class="btn btn-default">OK ! </button>
	</form>
</div>


<a href="index.php">Retour</a>

<?php include 'includes/footer.php';  