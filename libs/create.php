<?php
session_start();
include '../libs/verif.class.php';
include '../includes/functions.php';

$db = new connect('mff');
$pdo = $db->getPDO();

$user = new verif(0,$pdo);
$result = $user->createVerif($pdo,$_POST);



displayInfo($result);
header("Location:../inscription.php");

