<?php
session_start();

include 'verif.class.php';
include '../includes/functions.php';

$db = new connect('mff');
$pdo = $db->getPDO();

if(isset($_POST['email'])) $email = $_POST['email']; else $email = ""; 
if(isset($_POST['password'])) $password = $_POST['password']; else $password = "";

$user = new verif(0,$pdo);
$result = $user->logVerif($email,$password,$pdo);

debug($result);

displayInfo($result);
header("Location:../index.php");
