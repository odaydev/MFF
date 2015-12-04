<?php session_start();?>
<?php
 	if(isset($_SESSION['auth'])){
	 	require_once('libs/verif.class.php');
		
		$db = new connect('mff');	
		$pdo = $db->getPDO();
		
		if(isset($_SESSION['id'])) $id = $_SESSION['id']; else $id = 0;
		
		$user = new verif($id,$pdo);
	}	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Post it! | Home</title>
	<!--Tag for responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--FontAwesome-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!--Fonts-->
	<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

	<!--Styles + Reset-->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">

	<!--Favicon-->
	<link rel="icon" type="image/png" href="img/fav-icon.png" />
	<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/fav-icon.png" /><![endif]-->
</head>

<body>
	<div class="wrap">
	
		<header id="top-page" class="container clearfix">
				<div id="top-header" class="center">
					<h1 class="clearfix">
						<a id="logo" href="index.php">
							<img src="img/Logo.png" alt="Shoot | Logo"/>
							<span class="shoot">Post it!</span>
						</a>
					</h1>
					<i class="fa fa-bars left-menu"></i>					
					<div id="right-menu">
						<?php
							if(isset($_SESSION['auth'])){
								echo $_SESSION['auth'].'<br/>';
								echo "<a href='libs/deconnect.php'>Déconnexion</a>";
							}else{
						?>
						<form id="login" class="clearfix" action="libs/verif.php" method="POST">
							<input type="text" placeholder="email" name="email" value=""/>
							<input type="password" placeholder="password" name="password" />
							<input type="submit" name="connexion" value="connexion" />
						</form>
						<!--Disparait si on est logger-->
						<a href="">Mot de passe oublié</a>
						
						<!--Apparait une fois logger-->
					</div>
					<?php } ?>
					<div id="search">
						<i class="fa fa-search" id="search-icon"></i>						
					</div>
				</div>
				<nav id="top-nav" class="main-menu">
					<ul>
						<li><a class="center" href="index.php" title="home">Home<i class="fa fa-arrow-right"></i></a></li>
						<li><a class="center" href="pages.php" title="pages">Pages<i class="fa fa-arrow-right"></i></a></li>
						<!--Visible seulement une fois logger-->
						<?php
						if(isset($_SESSION['auth'])){
						?>
						<li><a class="center" href="profil.php" title="profil">Profil<i class="fa fa-arrow-right"></i></a></li>
						<!--Disparait si la personne est logger-->
						<?php
						}else{
						?>
						<li><a class="center" href="inscription.php" title="inscription">Inscription<i class="fa fa-arrow-right"></i></a></li>
						<?php } if(isset($_SESSION['auth'])){?>
						<!--Apparait une fois logger, permet de créer un topic-->
						<li><a class="center" href="addcontent.php" title="inscription">Post<i class="fa fa-arrow-right"></i></a></li>
						<?php } ?>
					</ul>
					<?php if (isset($_SESSION['success'])) { 
					echo '<h6 id="error-label" style="color: green;">'.$_SESSION['success'].'</h6>';
					unset($_SESSION['success']);
				}else if(isset($_SESSION['error'])){
							echo '<h6 id="error-label" style="color: red;">'.$_SESSION['error'].'</h6>';
							unset($_SESSION['error']);
						}else if(isset($_SESSION['info'])){
							echo '<h6 id="error-label" style="color: blue;">'.$_SESSION['info'].'</h6>';
							unset($_SESSION['info']);
						}//print_r($_SESSION);
			 ?>
				</nav>
		</header>
		<form id="search-field">
			<input type="search" name="search" id="search-input" value="Search"/>	
		</form>