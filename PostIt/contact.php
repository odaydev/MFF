<?php
session_start();
include 'includes/functions.php';


$result = isIsset($_POST);

if($result == "true"){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$adresse = $_POST['adresse'];
	$message = $_POST['message'];
	$date = date("d-m-Y H:i:s");

	$msg = "\r\n\r\n";
	$msg .= $date."\r\n".$name."\r\n".$email."\r\n".$adresse."\r\n".$message;


	$monfichier = fopen('contact\contacts.txt', 'a+');

	//fseek($monfichier, 0);
	fputs($monfichier, $msg);

	fclose($monfichier);

	$return[0] = 1;
	$return[1] = "Votre message a bien été transmis ! ";

}else{
	$return[0] = 2;
	$return[1] = "Erreur lors de la transmission du message ! ";
}

displayInfo($return);
header('Location:index.php#contact-form');