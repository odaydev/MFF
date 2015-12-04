<?php

include 'includes/functions.php';


$result = isIsset($_POST);

if($result == "true"){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$adresse = $_POST['adresse'];
	$message = $_POST['message'];

	$msg = $name.'\n'.$email.'\n'.$adresse.'\n'.$message;


	$monfichier = fopen('formation/motherFF/contact/contacts.txt', 'r+');

	fputs($monfichier, $msg);

	fclose($monfichier);

}