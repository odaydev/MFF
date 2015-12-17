<?php

include 'libs/verif.class.php';
include 'includes/functions.php';
$db = new connect('mff');	
$pdo = $db->getPDO();

if(isset($_GET["last"])) $last = $_GET["last"]; else $last = 1000000000;

$req1 = $pdo->prepare('SELECT * FROM post WHERE id > ? LIMIT 4');				
$req1->execute([$last]);
$posts = $req1->fetchAll(PDO::FETCH_OBJ);

$req2 = $pdo->prepare('SELECT users.login, users.photo FROM users WHERE users.id = ?');

$count = count($posts);
$attr = $last+1;

for($i=0;$i<$count;$i++){

	$id = $posts[$i]->creator_id;
	$req2->execute([$id]);
	$info_creator = $req2->fetch(PDO::FETCH_OBJ);
	
	?>

	<article class="topics-box clearfix" id="<?=$attr;?>">

		<div class="always-visible">
			<a href="content.php?idpost=<?=$posts[$i]->id;?>"><img class="topic-img" src="<?=$posts[$i]->image_post;?>"/></a>
			<h2><a href="content.php?idpost=<?=$posts[$i]->id;?>"><?=$posts[$i]->title_post;?></a></h2>
			<h3><a href="profil.php?id=<?=$id;?>"><?=$info_creator->login;?></a></h3>
			<img src="img/<?=$info_creator->photo;?>" alt="<?=$posts[$i]->title_post;?>" height="16" width="16"/>
			<h4><?=dateFormatFR($posts[$i]->created,2);?></h4>
		</div>
			<!--<p><?php//substr($posts[$i]->texte_post,0,180);echo"...";?></p>-->
	</article>
	<?php
	$attr++;
}

?>

