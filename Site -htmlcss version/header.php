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
						<a id="logo" href="index.html">
							<img src="img/Logo.png" alt="Shoot | Logo"/>
							<span class="shoot">Post it!</span>
						</a>
					</h1>
					<i class="fa fa-bars left-menu"></i>
					<div id="right-menu">
						<form id="login" class="clearfix" action="" method="POST">
							<input type="text" placeholder="email" name="auth[email]" value=""/>
							<input type="password" placeholder="password" name="auth[password]" />
							<input type="submit" name="action[connexion]" value="connexion" />
						</form>
						<!--Disparait si on est logger-->
						<a href="">Mot de passe oublié</a>
						<!--Apparait une fois logger-->
						<!--<a href="">Déconnexion</a>-->
					</div>
					<div id="search">
						<i class="fa fa-search" id="search-icon"></i>						
					</div>
				</div>
				<nav id="top-nav" class="main-menu">
					<ul>
						<li><a class="center" href="index.html" title="home">Home<i class="fa fa-arrow-right"></i></a></li>
						<li><a class="center" href="pages.html" title="pages">Pages<i class="fa fa-arrow-right"></i></a></li>
						<!--Visible seulement une fois logger-->
						<li><a class="center" href="profil.html" title="profil">Profil<i class="fa fa-arrow-right"></i></a></li>
						<!--Disparait si la personne est logger-->
						<li><a class="center" href="inscription.html" title="inscription">Inscription<i class="fa fa-arrow-right"></i></a></li>
						<!--Apparait une fois logger, permet de créer un topic-->
						<li><a class="center" href="addcontent.html" title="inscription">Post<i class="fa fa-arrow-right"></i></a></li>
					</ul>
				</nav>
		</header>
		<form id="search-field">
			<input type="search" name="search" id="search-input" value="Search"/>	
		</form>