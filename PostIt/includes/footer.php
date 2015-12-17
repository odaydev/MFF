<section id="second-part" class="clearfix">
	<div id="article-second-part">
		<article id="about">
			<div class="article-content">
				<h3>About MFF</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
				</article>
				<article id="keep-in-touch">
					<div class="article-content">
						<h3>Keep in touch</h3>
						<aside id="social-connect">
							<a href="" title="Shoot facebook"><i class="fa fa-facebook-official"></i></a>
							<a href="" title="Shoot twitter"><i class="fa fa-twitter"></i></a>
							<a href="https://plus.google.com/u/0/107035950534176610317" target="_blank" title="Shoot google+"><i class="fa fa-google-plus"></i></a>
							<a href="" title=" Shoot dribbble"><i class="fa fa-dribbble"></i></a>
							<a href="" title="Shoot behance"><i class="fa fa-behance"></i></a>
						</aside>
						<aside id="info">
							<div class="contact-info">
								<img src="img/location-icon.png" alt="adress" height="24" width="16"/>
								<h4>No 200, Av Balboa, Panamá, Panama</h4>
							</div>
							<div class="contact-info">
								<img src="img/phone-icon.png" alt="phone number" height="24" width="16"/>
								<h4>+44 (0) 800 765 4321</h4>
							</div>
							<div class="contact-info">
								<img src="img/mail-icon.png" alt="adress" height="24" width="16"/>
								<h4>mff.wf3@gmail.com</h4>
							</div>
						</aside>
					</div>
				</article>
				<article id="contact-form">
					<h3>Contact</h3>
					<form action="contact.php" method="POST">
						<input type="text" name="name" placeholder="Your name here" placeholder="" id="name" class="clearfix"/>
						<input type="text" name="email" placeholder="Your email here" placeholder="" id="email" class="clearfix"/>
						<input type="text" name="adresse" placeholder="Your adress here" placeholder="" id="adresse" class="clearfix"/>
						<textarea type="text" name="message" placeholder="Your message here" id="message" class="clearfix"></textarea>
						<div id="submit-btn">
							<input id="submit" type="submit" placeholder="SEND"/>
							<i class="fa fa-arrow-right"></i>
						</div>
					</form>
				</article>
			</div>
		</section>
		<footer>
			<div class="container">
				<div id="copyright">
					<p>&copy; 2016MotherFucking Forum. Built by MFF Team.</p>
					<p>Premium  Themes by MFF Team.</p>
				</div>
				<nav>
					<ul>
						<li><a class="center" href="index.php" title="home">Home</a></li>
						<li><a class="center" href="pages.php" title="pages">Pages</a></li>
						<!--Visible seulement une fois logger-->
						<?php
						if(isset($_SESSION['auth'])){
						?>
						<li><a class="center" href="profil.php" title="profil">Profil</a></li>
						<!--Disparait si la personne est logger-->
						<?php
						}else{
						?>
						<li><a class="center" href="inscription.php" title="inscription">Inscription</a></li>
						<?php } if(isset($_SESSION['auth'])){?>
						<!--Apparait une fois logger, permet de créer un topic-->
						<li><a class="center" href="addcontent.php" title="inscription">Post</a></li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</footer>

	</div>
	<!--Jquery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 	
	<script src="jPages/js/jPages.min.js"></script>
	<script src="js/animsition.js"></script>
	<script src="js/main.js"></script>
</body>
</html>