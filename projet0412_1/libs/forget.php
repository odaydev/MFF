<?php
include 'verif.class.php';
$db = new connect('mff');
$pdo = $db->getPDO();

if(isset($_GET['on'])) $get = $_GET['on']; else $get = 0;

if(isset($_POST['mail-forget'])){
	if($_POST['mail-forget'] == ""){
		$_SESSION['error'] = "Veuillez remplir le champ ! ";
		die(header("Location:forget.php"));
	}
}

if($get == 0){ ?>
<h2>Veuillez renseigner votre adresse email</h2>

<form action="forget.php?on=1" method="POST" class="form-inline" role="form">
	<input type="text" name="mail-forget" class="class_control">
	<button type="submit" class="btn btn-default">Envoyer ! </button>
</form>

<?php

}else{

	$mail_forget = $_POST['mail-forget'];

	$req = $pdo->prepare('SELECT email FROM users WHERE email = ?');
	$req->execute([$mail_forget]);

	$champ = $req->fetch(PDO::FETCH_OBJ);

	if($champ->email == ""){
		$_SESSION['error'] = "Votre adresse n'est pas présente dans notre base donnée ! ";
		die(header("Location:forget.php"));}
		else{
			?>

			<p>Par soucis de sécurité nous ne stockons aucune données sensibles en clair dans notre base de données. Par conséquent nous ne pouvons pas vous restituer votre mot de passe actuelle.</p>
			<p>Veuillez en entrer un nouveau, le retenir et ne plus me faire chier avec ça!!</p>
			<p>Merci!!!! ['OD@Y']</p>

			<form class="form-horizontal" action="libs/forgetT.php" method="POST">
				<label class="class-label">Mot de passe</label>
				<input type="password" class="class-control" name="psw1">

				<label class="class-label">Mot de passe 2</label>
				<input type="password" class="class-control" name="psw2">
				<input type="hidden" class="class-control" name="mail" value="<?=$mail_forget;?>">
				<button type="submit" class="btn btn-default">OK ! </button>
			</form>
			<?php
		}
	}

	?>


	<a href="index.php">Retour</a>

