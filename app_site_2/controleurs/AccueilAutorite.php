<?php 

$Prenom1=$_SESSION['Infos']['Prenom1'];

date_default_timezone_set("Europe/Paris");
$heure = date('H') . ':' . date('i') ;


/*

La partie PHP fonctionnera sur un vrai serveur mais ne fonctionne pas en local 

try {
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //Si l'utilisateur utilise un proxy
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
	$ville = $details->city;
} 
catch (Exception $e) {}

*/


require 'vues/AccueilAutorite.php'; 