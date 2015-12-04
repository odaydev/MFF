<?php
include('includes/header.php');
?>
	<section class="page-content clearfix">
				<form id="addcontent-form" class="topics-centered" action="" method="POST">
			<aside id="add-aside">
				<img src="img/share.png" alt="Share"/>
				<h1>Post your mood</h1>
			</aside>
			<!--
			<?php// if ( $error ) { ?>
			<h2 id="error-label" style="color: red;"><?=$error?></h2>
			<?php //} ?>
			-->
				<label for"photo">Illustration</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="12345" />
				<input type="file" placeholder="illustration" name="post[illustration]" value="" />
				
				<label for="title">Title</label>
				<input type="text" placeholder="title" name="post[title]" value="" />

				<label for="title">Categories</label>
				<input type="text" placeholder="categories" name="post[categories]" value="" />

				<label for="title">Meta</label>
				<input type="text" placeholder="meta" name="post[meta]" value="" />

				<label for="postmessage">Your mood!</label>
				<textarea type="text" placeholder="postmessage" name="post[message]" value="" /></textarea>

				<input type="submit" name="action[postcontent]" value="Post it!" />
			</form>
		</section>

<?php include('includes/footer.php');