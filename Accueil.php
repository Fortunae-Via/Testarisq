<?php

if (isset($_POST['identifiant'])) { 	/* et vérification mot de passe correct */

	$id=$_POST['identifiant'];

	if(stripos($id, 'aue') !== FALSE OR stripos($id, 'pol') !== FALSE) {
	   include 'AccueilAutorite.php'; 
	}

	else if(stripos($id, 'adm') !== FALSE) {
	   include 'AccueilAdministrateur.php'; 
	}

	else {
	   include 'AccueilCitoyen.php'; 
	}

}

else {
	include 'Authentification.php';
}


?>