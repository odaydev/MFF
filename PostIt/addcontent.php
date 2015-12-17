<?php include('includes/header.php'); ?>

	<section class="page-content clearfix">
		<form id="addcontent-form" class="topics-centered"  method="POST" action="post_add.php" ENCTYPE="multipart/form-data">
			<aside id="add-aside" class="clearfix">
				<img src="img/share.png" alt="Share"/>
				<h1>Post your mood</h1>
			</aside>
			
			<!--
				<h2 id="error-label" style="color: red;"><?=$error?></h2>
				<h2 id="error-label" style="color: green;"><?=$notError?></h2>
			-->

			<label for"fichier">Image <i>480px * 480px, format png, jpg, jpeg, gif autorisés.</i></label>
			<input type="file" placeholder="fichier" name="fichier" value="" multiple="multiple"/>
			
			<label for="title">Title <i>obligatoire</i></label>
			<input type="text" placeholder="title" name="title" value="" />

			<label for="categories">Categorie </label>
			<input type="text" placeholder="categories" name="categories" value="" />

			<label for="meta">Keywords <i>séparé les par une virgule</i></label>
			<input type="text" placeholder="meta" name="keywords" value="" />

			<label for="postmessage">Your mood! <i>obligatoire</i></label>
			<textarea type="text" placeholder="postmessage" name="message" value="" /></textarea>

			<input type="submit" value="Post it!" />
		</form>
	</section>

<?php include('includes/footer.php');