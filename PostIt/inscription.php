<?php include 'includes/header.php'; ?>
		
		<section class="page-content inscription">
			<form id="inscription-form" class="topics-centered" action="libs/create.php" method="POST">
			<aside id="inscription-aside">
				<img src="img/register.png" alt="Shoot | Logo"/>
				<h1>Welcome on Post it !</h1>
			</aside>
			<?php if (isset($_SESSION['success'])) { 
					echo '<h2 id="error-label" style="color: green;">'.$_SESSION['success'].'</h2>';
					unset($_SESSION['success']);
				}else if(isset($_SESSION['error'])){
							echo '<h2 id="error-label" style="color: red;">'.$_SESSION['error'].'</h2>';
							unset($_SESSION['error']);
						}else if(isset($_SESSION['info'])){
							echo '<h2 id="error-label" style="color: blue;">'.$_SESSION['info'].'</h2>';
							unset($_SESSION['info']);
						}//print_r($_SESSION);
			 ?>
				<label for"photo">Photo <i>64px * 64px</i></label>
				<input type="file" placeholder="photo" name="photo" value="" />
				
				<label for="name">Name <i>obligatoire</i></label>
				<input type="text" placeholder="name" name="name" value="" />

				<label for="pseudo">Pseudo <i>obligatoire</i></label>
				<input type="text" placeholder="pseudo" name="login" value="" />

				<label for="email">Email <i>obligatoire</i></label>
				<input type="email" placeholder="email" name="email" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" value="" />

				<label for="password">Password <i>obligatoire</i></label>
				<input type="password" placeholder="password" name="password" />

				<label for="repeatpassword">Repeat password <i>obligatoire</i></label>
				<input type="password" placeholder="repeatpassword" name="secondpassword" />

				<label for="birthday">Birthday <i>obligatoire</i></label>
				<input type="date" placeholder="00/00/0000" name="birthday" pattern="(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d" value=""/>


				<input type="submit" name="inscription" value="inscription" />
			</form>
		</section>

		<?php  include 'includes/footer.php'; ?>