<?php

/*session_start();
if ( empty($_SESSION['auth']) )
	die(header('Location: index.php?next=topics.php'));
*/

$error = "";
$notError = "";

?>

<?php include('includes/header.php'); ?>

	<section class="page-content clearfix">
		<form id="addcontent-form" class="topics-centered"  method="POST" action="post_add.php" ENCTYPE="multipart/form-data">
			<aside id="add-aside" class="clearfix">
				<img src="img/share.png" alt="Share"/>
				<h1>Post your mood</h1>
			</aside>
			
			<?php if ( $error ) { ?>
			<h2 id="error-label" style="color: red;">
			<?=$error?></h2>
			<?php }elseif($notError){ ?>
			<h2 id="error-label" style="color: green;">
			<?=$notError?></h2>
			<?php } ?>
		
			<label>Image</label>
			<input type="file" placeholder="fichier" name="fichier" value="" multiple="multiple"/>
			
			<label>Title</label>
			<input type="text" placeholder="title" name="title" value="" />

			<label>Categorie</label>
			<input type="text" placeholder="categorie" name="categorie" value="" />

			<label>Meta</label>
			<input type="text" placeholder="meta" name="meta" value="" />

			<label>Your mood!</label>
			<textarea type="text" placeholder="message" name="message" value="" /></textarea>

			<input type="submit" name="submit" value="Post it!" />
		</form>
	</section>

<?php include('includes/footer.php');