<?php

if(isset($_GET['to'])) $token = $_GET['to']; else $token = "fuck";
if(isset($_GET['i'])) $lastId = $_GET['i']; else $lastId = "fuck";
echo $token;
echo '<br/>'.$lastId;

$pdo = include '../conf/pdo.php';


$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$lastId]);

$user = $req->fetch(PDO::FETCH_OBJ);
echo '<br/>';
echo $date = time();
echo '<br/>';
echo $user->created_ts;
if(($user->created_ts+1800) >= $date)
{
	//$req1 = $pdo->prepare('INSERT INTO users (id,login,email,phone,password,birthday,created,confirmation_token,confirmed_at) VALUES ("","","","","","","","",?)');
	//$req1->execute([]);
	die("trop tard");
}


if($user->confirmation_token == $token){
	echo "yeah";
}else{
	echo "fuck2";
}