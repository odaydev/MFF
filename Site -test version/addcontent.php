<?php include('includes/header.php'); ?>

	<section class="page-content clearfix animsition">
		<form id="addcontent-form" class="topics-centered"  method="POST" action="post_add.php" ENCTYPE="multipart/form-data">
			<aside id="add-aside" class="clearfix">
				<img src="img/share.png" alt="Share"/>
				<h1>Post your mood</h1>
			</aside>
			
			<!--
				<h2 id="error-label" style="color: red;"><?=$error?></h2>
				<h2 id="error-label" style="color: green;"><?=$notError?></h2>
			-->

			<label for"fichier">Image</label>
			<input type="file" placeholder="fichier" name="fichier" value="" multiple="multiple"/>
			
			<label for="title">Title</label>
			<input type="text" placeholder="title" name="title" value="" />

			<label for="categories">Categories</label>
			<input type="text" placeholder="categories" name="categories" value="" />

			<label for="meta">Keywords</label>
			<input type="text" placeholder="meta" name="keywords" value="" />

			<label for="postmessage">Your mood!</label>
			<textarea type="text" placeholder="postmessage" name="message" value="" /></textarea>

			<input type="submit" value="Post it!" />
		</form>
	</section>

<?php include('includes/footer.php');