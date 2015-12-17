<?php
session_start();
header('Content-type: application/json');
include '../libs/verif.class.php';
include '../includes/functions.php';

if(isset($_GET['idpost'])) $idpost = $_GET['idpost']; else $idpost = "";

$db = new connect('mff');
$pdo = $db->getPDO();
$reqVerif = $pdo->prepare('SELECT * FROM votes WHERE ref_id = ? AND user_id = ? AND vote = 1');
$reqVerif->execute([$idpost,$_SESSION['id']]);
$count = $reqVerif->rowCount();
//debug($count,1);
if($count>0){
	
	$verif = $reqVerif->fetch(PDO::FETCH_OBJ);
	
	if($verif->vote == 1){
		
		$req = $pdo->prepare('UPDATE post SET like_post = like_post-1 WHERE id = ?');
		$req->execute([$idpost]);

		$reqUpdate = $pdo->prepare('UPDATE votes SET vote = 0 WHERE user_id = ? AND ref_id = ?');
		$reqUpdate->execute([$_SESSION['id'],$idpost]);

		$req1 = $pdo->prepare('SELECT like_post FROM post WHERE id = ?');
		$req1->execute([$idpost]);

		$like = $req1->fetch(PDO::FETCH_OBJ);

	}else{

		$req = $pdo->prepare('UPDATE post SET like_post = like_post+1 WHERE id = ?');
		$req->execute([$idpost]);

		$reqUpdate = $pdo->prepare('UPDATE votes SET vote = 1 WHERE user_id = ? AND ref_id = ?');
		$reqUpdate->execute([$_SESSION['id'],$idpost]);

		$req1 = $pdo->prepare('SELECT like_post FROM post WHERE id = ?');
		$req1->execute([$idpost]);

		$like = $req1->fetch(PDO::FETCH_OBJ);
	}
}else{

	$reqInsert = $pdo->prepare('INSERT INTO votes (id,ref_id,ref,user_id,vote,created_at) VALUES ("",?,?,?,?,?)');
	$reqInsert->execute([$idpost,"post",$_SESSION['id'],1,date("Y-m-d H:i:s")]);

	$req = $pdo->prepare('UPDATE post SET like_post = like_post+1 WHERE id = ?');
	$req->execute([$idpost]);

	$req1 = $pdo->prepare('SELECT like_post FROM post WHERE id = ?');
	$req1->execute([$idpost]);
	$like = $req1->fetch(PDO::FETCH_OBJ);
}



print_r(json_encode($like));
