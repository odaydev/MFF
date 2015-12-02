<?php
// http://www.berejeb.com/2009/09/envoyer-des-mails-avec-phpmailer-et-le-smtp-de-gmail/
require_once('../../phpmailer/class.phpmailer.php'); 
require_once('../../phpmailer/class.smtp.php'); 
require_once '../../phpmailer/PHPMailerAutoload.php';
//require '../../inc/functions.php';
define('GMailUSER', 'oday972@gmail.com'); // utilisateur Gmail
define('GMailPWD', 'M@dinina972'); // Mot de passe Gmail

function smtpMailer($to, $from, $from_name, $subject, $body) {
	$mail = new PHPMailer();  // Cree un nouvel objet PHPMailer
	$mail->IsSMTP(); // active SMTP
	$mail->IsHTML(true);
	$mail->CharSet = "utf-8";
	$mail->SMTPDebug = 2;  // debogage: 1 = Erreurs et messages, 2 = messages seulement
	$mail->SMTPAuth = true;  // Authentification SMTP active
	$mail->SMTPSecure = 'ssl'; // Gmail REQUIERT Le transfert securise
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->Username = GMailUSER;
	$mail->Password = GMailPWD;
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	$mail->setLanguage('fr', '/optional/path/to/language/directory/');
	//debug($mail);
	if(!$mail->Send()) {
		return 'Mail error: '.$mail->ErrorInfo;
	} else {
		return true;
	}
}