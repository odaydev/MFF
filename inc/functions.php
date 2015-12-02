<?php

function debug($var, $die=false){
	echo '<pre>' . print_r($var, true) . '</pre>';
	if($die == true){die();}
}

function str_random($length){
	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
	return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}