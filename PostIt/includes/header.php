<?php session_start();?>
<?php
	require_once('libs/verif.class.php');
	$db = new connect('mff');	
	$pdo = $db->getPDO();
 	if(isset($_SESSION['auth'])){		
		
		if(isset($_SESSION['id'])) $id = $_SESSION['id']; else $id = 0;
		
		$user = new verif($id,$pdo);
	}
	if(isset($_GET['id'])){

		$id = $_GET['id']; 
		
		$user = new verif($id,$pdo);
	}	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Post it!</title>
	<!--Tag for responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--FontAwesome-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!--Fonts-->
	<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	
	<!--Pagination-->
	<link rel="stylesheet" href="jPages/css/jPages.css">

	<!--Styles + Reset-->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">

	<!--Favicon-->
	<link rel="icon" type="image/png" href="img/fav-icon.png" />
	<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/fav-icon.png" /><![endif]-->

	<!--Animsition-->
	<link rel="stylesheet" href="css/animsition.css">
	

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
					<i class="left-menu"><span></span></i>					
					<div id="search">
						<i class="fa fa-search" id="search-icon"></i>						
					</div>
					<div id="right-menu">
						<?php
							if(isset($_SESSION['auth'])){?>

								<div class="connected clearfix">
									<a href="profil.php">
										<img src="img/<?=$_SESSION['photo'];?>" alt="user1" height="32" width="32"/>
										<h4><?=	$_SESSION['auth']?></h4>						
									</a>
								</div>
								<a id="logout" href='libs/deconnect.php'>Logout</a>
							<?php }else{?>

						<!--Only pour le responsive-->
						<i id="mini-login" class="fa fa-square-o"></i>
						<form id="login" class="clearfix" action="libs/verif.php" method="POST">
							<input type="text" placeholder="email" name="email" value=""/>
							<input type="password" placeholder="password" name="password" />
							<input type="submit" name="connexion" value="connexion" />
							<!--Disparait si on est logger-->
							<a id="forget" href="forget.php">Mot de passe oublié</a>
						</form>
						
						<!--Apparait une fois logger-->
					</div>
					<?php } ?>
				</div>
				<nav id="top-nav" class="main-menu clearfix">
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

				</nav>
		</header>
		<!-- Affichage des erreurs  -->
		<form id="search-field">
			<input type="search" name="search" id="search-input" placeholder="Search"/>
			<span id="reslut_search">	</span>	
		</form>
		<?php if (isset($_SESSION['message']['success'])){ 
			  	echo '<h6 id="error-label" style="color: green;">'.$_SESSION['message']['success'].'</h6>';
				unset($_SESSION['message']);							
			}else if(isset($_SESSION['message']['error'])){
				echo '<h6 id="error-label" style="color: red;">'.$_SESSION['message']['error'].'</h6>';
				unset($_SESSION['message']);
			}else if(isset($_SESSION['message']['info'])){
				echo '<h6 id="error-label" style="color: blue;">'.$_SESSION['message']['info'].'</h6>';
				unset($_SESSION['message']);
			}
		?>